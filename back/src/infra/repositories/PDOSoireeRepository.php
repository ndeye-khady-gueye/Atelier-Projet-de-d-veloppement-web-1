<?php
declare(strict_types=1);

namespace nrv\infra\repositories;

use DateTimeImmutable;
use nrv\core\application\ports\spi\SoireeRepositoryInterface;
use nrv\core\domain\entities\JaugeSoiree;
use nrv\core\domain\entities\Lieu;
use nrv\core\domain\entities\Soiree;
use nrv\core\domain\exceptions\EntityNotFoundException;
use PDO;

class PDOSoireeRepository implements SoireeRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findAll(): array
    {
        $rows = $this->pdo->query(
            'SELECT so.id, so.nom, so.thematique, so.date_debut, so.places_vendues,
                    l.id AS lieu_id, l.nom AS lieu_nom, l.adresse, l.nb_places
             FROM soiree so JOIN lieu l ON l.id = so.lieu_id
             ORDER BY so.date_debut'
        )->fetchAll();
        return array_map(fn (array $r) => $this->hydrater($r), $rows);
    }

    public function findById(int $id): Soiree
    {
        $stmt = $this->pdo->prepare(
            'SELECT so.id, so.nom, so.thematique, so.date_debut, so.places_vendues,
                    l.id AS lieu_id, l.nom AS lieu_nom, l.adresse, l.nb_places
             FROM soiree so
             JOIN lieu l ON l.id = so.lieu_id
             WHERE so.id = :id'
        );
        $stmt->execute(['id' => $id]);
        $r = $stmt->fetch();
        if ($r === false) {
            throw new EntityNotFoundException("Soirée $id introuvable");
        }
        return $this->hydrater($r);
    }

    private function hydrater(array $r): Soiree
    {
        return new Soiree(
            (int) $r['id'],
            $r['nom'],
            $r['thematique'],
            new DateTimeImmutable($r['date_debut']),
            new Lieu((int) $r['lieu_id'], $r['lieu_nom'], $r['adresse'], (int) $r['nb_places']),
            (int) $r['places_vendues']
        );
    }

    public function findAllJauges(): array
    {
        $rows = $this->pdo->query(
            'SELECT so.id, so.nom, so.date_debut, so.places_vendues, l.nom AS lieu, l.nb_places,
                    COALESCE((SELECT SUM(b.prix) FROM billet b WHERE b.soiree_id = so.id), 0) AS recette
             FROM soiree so
             JOIN lieu l ON l.id = so.lieu_id
             ORDER BY so.date_debut'
        )->fetchAll();
        return array_map(fn (array $r) => new JaugeSoiree(
            (int) $r['id'],
            $r['nom'],
            new DateTimeImmutable($r['date_debut']),
            $r['lieu'],
            (int) $r['nb_places'],
            (int) $r['places_vendues'],
            (float) $r['recette']
        ), $rows);
    }
}
