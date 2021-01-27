<?php
namespace App\Shared\Utility;

use App\Shared\Domain\Entities\PaginateEntity;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class PaginationRecords
{

    private $connection;
    private $logger;

    public function __construct(PDO $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    public function getData(string $countSql, string $dataSql, int $page, int $limit): object {

        try{

            $offset = ($page-1) * $limit; //calculate what data you want

            $countQuery = $this->connection->prepare( $countSql );
            $dataQuery = $this->connection->prepare( $dataSql );
            $dataQuery->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $dataQuery->bindParam(':offset', $offset, \PDO::PARAM_INT);

            $dataQuery->execute();
            $countQuery->execute();
            $this->connection = null; // clear db object
            $count = $countQuery->fetch(PDO::FETCH_ASSOC);
            $num = $count['COUNT'];
            if($num > 0){

                $paginateEntity = new PaginateEntity();
                $paginateEntity->setCountRows($num);
                $paginateEntity->setCurrentPage($page);
                $paginateEntity->setLimitRows($limit);
                $paginateEntity->setRows($dataQuery->fetchAll(PDO::FETCH_ASSOC));
                $paginateEntity->setTotalPerPages(ceil($num/$limit));

                return $paginateEntity;

            } else {

                return new \stdClass();

            }

        } catch( PDOException $e ) {
            $this->logger->error($e->getMessage());
            return new \stdClass();
        }
    }

}
