<?php
namespace App\Shared\Infrastructure\Persistence;

use App\Shared\Domain\Entities\PaginateEntity;
use App\Shared\Domain\Repository\RepositoryInterface;
use App\Shared\Exception\Commands\FindActionException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use PDO;
use Psr\Log\LoggerInterface;
use stdClass;
use Throwable;

class BaseRepository implements RepositoryInterface
{

    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function addResource(array $request): bool
    {
        // TODO: Implement addResource() method.
        return true;
    }

    public function editResource(array $request, int $id): bool
    {
        // TODO: Implement editResource() method.
        return true;
    }

    public function removeResource(array $request, int $id): bool
    {
        // TODO: Implement removeResource() method.
        return true;
    }

    public function readResource(int $id): array
    {
        // TODO: Implement readResource() method.
        return [];
    }

    public function readAllResource(array $query, bool $usingPaginate): object
    {
        // TODO: Implement readAllResource() method.
        return new stdClass();
    }
}