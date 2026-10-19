<?php
declare(strict_types=1);

namespace nrv\infra\repositories;

use DateTimeImmutable;
use nrv\core\application\ports\spi\SpectacleRepositoryInterface;
use nrv\core\domain\entities\Spectacle;
use nrv\core\domain\entities\Style;
use PDO;

class PDOSpectacleRepository implements SpectacleRepositoryInterface
{
    private const SELECT = 'SELECT sp.id, sp.titre, sp.description, sp.url_video, sp.horaire_previsionnel,
                                   sp.soiree_id, st.id AS style_id, st.libelle AS style_libelle
                            FROM spectacle sp
                            JOIN style st ON st.id = sp.style_id
                            JOIN soiree so ON so.id = sp.soiree_id';

    public function __construct(private PDO $pdo)
    {
    }

    public function findAll(?DateTimeImmutable $date, ?int $styleId, int $offset, int $limit): array
    {
        [$where, $params] = $this->filtres($date, $styleId);
        $stmt = $this->pdo->prepare(
            self::SELECT . $where . ' ORDER BY sp.horaire_previsionnel, sp.id LIMIT :limit OFFSET :offset'
        );
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return array_map(fn (array $r) => $this->hydrater($r), $stmt->fetchAll());
    }

    public function count(?DateTimeImmutable $date, ?int $styleId): int
    {
        [$where, $params] = $this->filtres($date, $styleId);
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(*) FROM spectacle sp JOIN soiree so ON so.id = sp.soiree_id' . $where
        );
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }

    public function findBySoiree(int $soireeId): array
    {
        $stmt = $this->pdo->prepare(self::SELECT . ' WHERE sp.soiree_id = :soiree ORDER BY sp.horaire_previsionnel');
        $stmt->execute(['soiree' => $soireeId]);
        return array_map(fn (array $r) => $this->hydrater($r), $stmt->fetchAll());
    }

    /** @return array{0: string, 1: array<string, mixed>} */
    private function filtres(?DateTimeImmutable $date, ?int $styleId): array
    {
        $conditions = [];
        $params = [];
        if ($date !== null) {
            // la date d'un spectacle est celle de sa soirée
            $conditions[] = 'so.date_debut >= :debut AND so.date_debut < :fin';
            $params['debut'] = $date->format('Y-m-d 00:00:00');
            $params['fin'] = $date->modify('+1 day')->format('Y-m-d 00:00:00');
        }
        if ($styleId !== null) {
            $conditions[] = 'sp.style_id = :style';
            $params['style'] = $styleId;
        }
        $where = $conditions === [] ? '' : ' WHERE ' . implode(' AND ', $conditions);
        return [$where, $params];
    }

    private function hydrater(array $r): Spectacle
    {
        $id = (int) $r['id'];
        return new Spectacle(
            $id,
            $r['titre'],
            $r['description'],
            $r['url_video'],
            new DateTimeImmutable($r['horaire_previsionnel']),
            new Style((int) $r['style_id'], $r['style_libelle']),
            (int) $r['soiree_id'],
            $this->colonne(
                'SELECT a.nom FROM artiste a JOIN spectacle_artiste sa ON sa.artiste_id = a.id
                 WHERE sa.spectacle_id = :id ORDER BY a.nom',
                $id
            ),
            $this->colonne('SELECT url FROM image WHERE spectacle_id = :id ORDER BY id', $id)
        );
    }

    /** @return string[] */
    private function colonne(string $sql, int $id): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
