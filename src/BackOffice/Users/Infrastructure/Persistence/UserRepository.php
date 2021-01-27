<?php
namespace App\BackOffice\Users\Infrastructure\Persistence;

use App\BackOffice\Users\Domain\Entities\UserModel;
use App\BackOffice\Users\Domain\Repository\UserRepositoryInterface;
use App\Shared\Domain\Repository\RepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use App\Shared\Utility\PaginationRecords;
use App\Shared\Utility\PdoUtils;
use Exception;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;
use stdClass;

class UserRepository implements RepositoryInterface
{

    private ?PDO $connection;
    private PaginationRecords $paginateRecords;
    private LoggerInterface $logger;
    private PdoUtils $pdoUtils;

    public function __construct(PDO $connection, PaginationRecords $paginateRecords, LoggerInterface $logger, PdoUtils $pdoUtils)
    {
        $this->connection = $connection;
        $this->paginateRecords = $paginateRecords;
        $this->logger = $logger;
        $this->pdoUtils = $pdoUtils;
    }

    public function addResource(array $request): bool
    {
        $sql = $this->pdoUtils->buildingSqlInsert($request);

        try {

            $stmt = $this->connection->prepare($sql);
            $this->pdoUtils->bindParams($request, $stmt);
            $stmt->execute();
            return true;

        } catch( PDOException $e ) {

            $this->logger->error($e->getMessage());
            return false;

        }

    }

    public function editResource(array $request, string $id): bool
    {
        $sql = '';
        $this->pdoUtils->buildingSqlUpdate($request,"user", $sql);
        $this->pdoUtils->buildingSqlWhere($id, $sql);

        try {

            $stmt = $this->connection->prepare($sql);
            $this->pdoUtils->bindParams($request, $stmt);
            $stmt->execute();
            return true;

        } catch( PDOException $e ) {
            $this->logger->error($e->getMessage());
            return false;
        }

    }

    public function removeResource(array $request, string $id): bool
    {
        $sql = '';
        $this->pdoUtils->buildingSqlDelete($request, "user" ,$sql);
        $this->pdoUtils->buildingSqlWhere($id, $sql);

        try{

            $stmt = $this->connection->prepare($sql);

            $this->pdoUtils->bindParams($request, $stmt);

            $stmt->execute();

            return true;

        } catch( PDOException $e ) {
            $this->logger->error($e->getMessage());
            return false;
        }

    }

    public function readResource(string $id): object
    {
        $sql = "SELECT * FROM user WHERE uuid = '" . $id . "'";

        try{

            $rs = $this->connection->query($sql, PDO::FETCH_OBJ);
            $fetch = $rs->fetch();
            $this->connection = null;
            return $fetch;
        } catch( PDOException $e ) {
            $this->logger->error($e->getMessage());
            return new \stdClass();
        }
    }

    public function readAllResource(array $query): object
    {
        try{

            $countSql = "SELECT COUNT(*) as COUNT FROM user";
            $dataSql  = "SELECT * FROM user LIMIT :limit OFFSET :offset";
            return $this->paginateRecords->getData($countSql, $dataSql, $query['page'], $query['limit']);

        } catch( PDOException $e ) {

            $this->logger->error($e->getMessage());
            return new \stdClass();
        }

    }

    public function isDuplicateEmailInAdd(string $email): bool {
        try {
            $sql = "";
            $sql .= "SELECT email FROM user WHERE email = '" . $email . "'";
            $query = $this->connection->query($sql);
            return ($query->rowCount() > 0);
        } catch ( PDOException $e ) {
            $this->logger->error($e->getMessage());
            return false;
        }
    }

    public function isDuplicateEmailInEdit(string $email, string $id): bool {
        try {
            $sql = "";
            $sql .= "SELECT email FROM user WHERE email = '" . $email . "' AND uuid != '" . $id . "'" ;
            $query = $this->connection->query($sql);
            $count = $query->rowCount();
            return ($query->rowCount() > 0);
        } catch ( PDOException $e ) {
            $this->logger->error($e->getMessage());
            return false;
        }
    }

    public function searchUserById(string $id): bool {
        try {
            $sql = "";
            $sql .= "SELECT uuid FROM user WHERE uuid = '" . $id . "' AND deleted_at IS NULL";
            $query = $this->connection->query($sql);
            return ($query->rowCount() > 0);
        } catch ( PDOException $e ) {
            $this->logger->error($e->getMessage());
            return false;
        }
    }

    /*public function getIdResourceByUuid(string $uuid) {
        $rs = $this->connection->query("SELECT * FROM user WHERE uuid = '" . $uuid. "'", PDO::FETCH_OBJ);
        $fetch = $rs->fetch();
        return $uuid;
    }*/
}