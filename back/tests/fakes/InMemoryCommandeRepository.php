<?php
declare(strict_types=1);

namespace nrv\tests\fakes;

use nrv\core\application\ports\spi\CommandeRepositoryInterface;
use nrv\core\domain\entities\Billet;
use nrv\core\domain\entities\Commande;
use nrv\core\domain\exceptions\EntityNotFoundException;
use nrv\core\domain\exceptions\PlacesInsuffisantesException;

final class InMemoryCommandeRepository implements CommandeRepositoryInterface
{
    /** @var Commande[] */
    public array $commandes = [];
    /** @var array<int, Billet[]> */
    public array $billets = [];
    /** @var array<int, int> places restantes par soirée (pour simuler le contrôle en base) */
    public array $placesRestantes = [];

    public function creer(Commande $c): Commande
    {
        $id = count($this->commandes) + 1;
        return $this->commandes[$id] = new Commande($id, $c->utilisateurId, $c->date, $c->montant, $c->statut, $c->lignes);
    }

    public function findById(int $id): Commande
    {
        return $this->commandes[$id] ?? throw new EntityNotFoundException("Commande $id introuvable");
    }

    public function enregistrerPaiement(Commande $c, array $billets): void
    {
        foreach ($c->billetsParSoiree() as $soireeId => $n) {
            if (isset($this->placesRestantes[$soireeId]) && $this->placesRestantes[$soireeId] < $n) {
                throw new PlacesInsuffisantesException("Plus assez de places pour la soirée $soireeId");
            }
        }
        foreach ($c->billetsParSoiree() as $soireeId => $n) {
            if (isset($this->placesRestantes[$soireeId])) {
                $this->placesRestantes[$soireeId] -= $n;
            }
        }
        $this->billets[$c->id] = $billets;
        $this->commandes[$c->id] = new Commande($c->id, $c->utilisateurId, $c->date, $c->montant, Commande::PAYEE, $c->lignes);
    }

    public function findBilletsByCommande(int $commandeId): array
    {
        return array_map(fn (Billet $b) => $this->ligne($b), $this->billets[$commandeId] ?? []);
    }

    public function findBilletByToken(string $token): array
    {
        foreach ($this->billets as $liste) {
            foreach ($liste as $b) {
                if ($b->token === $token) {
                    return $this->ligne($b);
                }
            }
        }
        throw new EntityNotFoundException('Billet introuvable');
    }

    private function ligne(Billet $b): array
    {
        return [
            'reference' => $b->reference, 'token' => $b->token, 'categorie' => $b->categorie, 'prix' => $b->prix,
            'acheteur' => 'Marc Dubois', 'soiree' => "Soirée {$b->soireeId}", 'debut' => '2027-06-12 20:00:00',
            'lieu' => 'Zénith', 'adresse' => 'Maxéville',
        ];
    }
}
