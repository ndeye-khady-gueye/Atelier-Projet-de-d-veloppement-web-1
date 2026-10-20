<?php
declare(strict_types=1);

namespace nrv\infra\repositories;

use nrv\core\application\ports\spi\StyleRepositoryInterface;
use nrv\core\domain\entities\Style;
use PDO;

class PDOStyleRepository implements StyleRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findAll(): array
    {
        $rows = $this->pdo->query('SELECT id, libelle FROM style ORDER BY libelle')->fetchAll();
        return array_map(fn (array $r) => new Style((int) $r['id'], $r['libelle']), $rows);
    }
}
