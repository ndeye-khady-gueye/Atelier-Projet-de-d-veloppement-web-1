<?php
declare(strict_types=1);

namespace nrv\infra\repositories;

use DateTimeImmutable;
use nrv\core\application\ports\spi\CommandeRepositoryInterface;
use nrv\core\domain\entities\Commande;
use nrv\core\domain\entities\LigneCommande;
use nrv\core\domain\exceptions\EntityNotFoundException;
use nrv\core\domain\exceptions\PlacesInsuffisantesException;
use PDO;
use Throwable;

class PDOCommandeRepository implements CommandeRepositoryInterface
{
    private const SELECT_BILLET = 'SELECT b.reference, b.token, b.categorie, b.prix, u.nom AS acheteur,
                                          so.nom AS soiree, so.date_debut AS debut, l.nom AS lieu, l.adresse
                                   FROM billet b
                                   JOIN commande c ON c.id = b.commande_id
                                   JOIN utilisateur u ON u.id = c.utilisateur_id
                                   JOIN soiree so ON so.id = b.soiree_id
                                   JOIN lieu l ON l.id = so.lieu_id';

    public function __construct(private PDO $pdo)
    {
    }

    public function creer(Commande $commande): Commande
    {
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare(
                'INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut)
                 VALUES (:u, :d, :m, :s) RETURNING id'
            );
            $stmt->execute([
                'u' => $commande->utilisateurId,
                'd' => $commande->date->format('Y-m-d H:i:s'),
                'm' => $commande->montant,
                's' => $commande->statut,
            ]);
            $id = (int) $stmt->fetchColumn();
            $ligne = $this->pdo->prepare(
                'INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire, pass_id)
                 VALUES (:c, :s, :cat, :q, :p, :pass)'
            );
            foreach ($commande->lignes as $l) {
                $ligne->execute([
                    'c' => $id, 's' => $l->soireeId, 'cat' => $l->categorie,
                    'q' => $l->quantite, 'p' => $l->prixUnitaire, 'pass' => $l->passId,
                ]);
            }
            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
        return new Commande($id, $commande->utilisateurId, $commande->date, $commande->montant, $commande->statut, $commande->lignes);
    }

    public function findById(int $id): Commande
    {
        $stmt = $this->pdo->prepare('SELECT * FROM commande WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $r = $stmt->fetch();
        if ($r === false) {
            throw new EntityNotFoundException("Commande $id introuvable");
        }
        $stmt = $this->pdo->prepare('SELECT * FROM ligne_commande WHERE commande_id = :id ORDER BY id');
        $stmt->execute(['id' => $id]);
        $lignes = array_map(fn (array $l) => new LigneCommande(
            (int) $l['soiree_id'],
            $l['categorie'],
            (int) $l['quantite'],
            (float) $l['prix_unitaire'],
            $l['pass_id']
        ), $stmt->fetchAll());
        return new Commande(
            (int) $r['id'],
            (int) $r['utilisateur_id'],
            new DateTimeImmutable($r['date_commande']),
            (float) $r['montant_total'],
            $r['statut'],
            $lignes
        );
    }

    public function enregistrerPaiement(Commande $commande, array $billets): void
    {
        $this->pdo->beginTransaction();
        try {
            // décompte atomique : la mise à jour échoue si la capacité du lieu serait dépassée
            $places = $this->pdo->prepare(
                'UPDATE soiree SET places_vendues = places_vendues + :n
                 WHERE id = :s AND places_vendues + :n2 <= (SELECT nb_places FROM lieu WHERE lieu.id = soiree.lieu_id)
                 RETURNING nom'
            );
            foreach ($commande->billetsParSoiree() as $soireeId => $n) {
                $places->execute(['n' => $n, 'n2' => $n, 's' => $soireeId]);
                if ($places->fetchColumn() === false) {
                    throw new PlacesInsuffisantesException("Plus assez de places pour la soirée $soireeId");
                }
            }
            $stmt = $this->pdo->prepare(
                'INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token)
                 VALUES (:c, :s, :r, :cat, :p, :t)'
            );
            foreach ($billets as $b) {
                $stmt->execute([
                    'c' => $commande->id, 's' => $b->soireeId, 'r' => $b->reference,
                    'cat' => $b->categorie, 'p' => $b->prix, 't' => $b->token,
                ]);
            }
            $stmt = $this->pdo->prepare("UPDATE commande SET statut = 'payee' WHERE id = :id AND statut = 'en_attente'");
            $stmt->execute(['id' => $commande->id]);
            if ($stmt->rowCount() !== 1) {
                throw new \RuntimeException('Commande déjà payée');
            }
            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function findBilletsByCommande(int $commandeId): array
    {
        $stmt = $this->pdo->prepare(self::SELECT_BILLET . ' WHERE b.commande_id = :c ORDER BY so.date_debut, b.id');
        $stmt->execute(['c' => $commandeId]);
        return $stmt->fetchAll();
    }

    public function findBilletByToken(string $token): array
    {
        $stmt = $this->pdo->prepare(self::SELECT_BILLET . " WHERE b.token = :t AND c.statut = 'payee'");
        $stmt->execute(['t' => $token]);
        $r = $stmt->fetch();
        if ($r === false) {
            throw new EntityNotFoundException('Billet introuvable');
        }
        return $r;
    }
}
