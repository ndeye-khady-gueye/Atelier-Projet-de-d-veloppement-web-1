<?php
declare(strict_types=1);

namespace nrv\infra\repositories;

use DateTimeImmutable;
use nrv\core\application\ports\spi\PanierRepositoryInterface;
use nrv\core\domain\entities\LignePanier;
use nrv\core\domain\entities\Panier;
use PDO;

class PDOPanierRepository implements PanierRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findByUtilisateur(int $utilisateurId): Panier
    {
        $stmt = $this->pdo->prepare(
            'SELECT lp.id, lp.soiree_id, lp.categorie, lp.quantite, lp.pass_id, so.nom, so.date_debut
             FROM ligne_panier lp
             JOIN panier p ON p.id = lp.panier_id
             JOIN soiree so ON so.id = lp.soiree_id
             WHERE p.utilisateur_id = :u
             ORDER BY so.date_debut, lp.id'
        );
        $stmt->execute(['u' => $utilisateurId]);
        $lignes = array_map(fn (array $r) => new LignePanier(
            (int) $r['id'],
            (int) $r['soiree_id'],
            $r['nom'],
            new DateTimeImmutable($r['date_debut']),
            $r['categorie'],
            (int) $r['quantite'],
            $r['pass_id']
        ), $stmt->fetchAll());
        return new Panier($utilisateurId, $lignes);
    }

    public function ajouterLigne(int $utilisateurId, int $soireeId, string $categorie, int $quantite, ?string $passId = null): void
    {
        $panierId = $this->panierId($utilisateurId);
        if ($passId === null) {
            // même soirée et même tarif déjà présents (hors pass) : on augmente la quantité
            $stmt = $this->pdo->prepare(
                'UPDATE ligne_panier SET quantite = quantite + :q
                 WHERE panier_id = :p AND soiree_id = :s AND categorie = :c AND pass_id IS NULL'
            );
            $stmt->execute(['q' => $quantite, 'p' => $panierId, 's' => $soireeId, 'c' => $categorie]);
            if ($stmt->rowCount() > 0) {
                return;
            }
        }
        $stmt = $this->pdo->prepare(
            'INSERT INTO ligne_panier (panier_id, soiree_id, categorie, quantite, pass_id) VALUES (:p, :s, :c, :q, :pass)'
        );
        $stmt->execute(['p' => $panierId, 's' => $soireeId, 'c' => $categorie, 'q' => $quantite, 'pass' => $passId]);
    }

    public function modifierQuantite(int $utilisateurId, int $ligneId, int $quantite): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE ligne_panier SET quantite = :q
             WHERE id = :id AND panier_id = (SELECT id FROM panier WHERE utilisateur_id = :u)'
        );
        $stmt->execute(['q' => $quantite, 'id' => $ligneId, 'u' => $utilisateurId]);
    }

    public function supprimerLigne(int $utilisateurId, int $ligneId): void
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM ligne_panier lp USING panier p
             WHERE lp.panier_id = p.id AND p.utilisateur_id = :u
               AND (lp.id = :id OR lp.pass_id = (SELECT pass_id FROM ligne_panier WHERE id = :id2))'
        );
        $stmt->execute(['u' => $utilisateurId, 'id' => $ligneId, 'id2' => $ligneId]);
    }

    public function vider(int $utilisateurId): void
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM ligne_panier WHERE panier_id = (SELECT id FROM panier WHERE utilisateur_id = :u)'
        );
        $stmt->execute(['u' => $utilisateurId]);
    }

    /** Id du panier de l'utilisateur, créé au premier ajout. */
    private function panierId(int $utilisateurId): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO panier (utilisateur_id) VALUES (:u)
             ON CONFLICT (utilisateur_id) DO UPDATE SET utilisateur_id = EXCLUDED.utilisateur_id
             RETURNING id'
        );
        $stmt->execute(['u' => $utilisateurId]);
        return (int) $stmt->fetchColumn();
    }
}
