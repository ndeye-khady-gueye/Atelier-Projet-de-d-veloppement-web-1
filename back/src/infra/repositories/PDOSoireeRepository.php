<?php
declare(strict_types=1);

namespace nrv\infra\repositories;

use DateTimeImmutable;
use nrv\core\application\ports\spi\SoireeRepositoryInterface;
use nrv\core\domain\entities\Lieu;
use nrv\core\domain\entities\Soiree;
use nrv\core\domain\exceptions\EntityNotFoundException;
use PDO;

class PDOSoireeRepository implements SoireeRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
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
        return new Soiree(
            (int) $r['id'],
            $r['nom'],
            $r['thematique'],
            new DateTimeImmutable($r['date_debut']),
            new Lieu((int) $r['lieu_id'], $r['lieu_nom'], $r['adresse'], (int) $r['nb_places']),
            (int) $r['places_vendues']
        );
    }
}
