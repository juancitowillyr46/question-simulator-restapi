<?php
namespace App\Shared\Utility;

use PDO;

class PdoUtils
{
    public function bindParams(array $request, &$stmt):void {
        $keys = array_keys($request);
        foreach ($keys as $key) {
            $stmt->bindParam(':'.$key, $request[$key], PDO::PARAM_STR);
        }
    }

    public function buildingSqlInsert($data) {
        $keys = array_keys($data);
        $sql = "INSERT INTO user (";
        $sql .= implode(",", $keys);
        $sql .= ")";
        $sql .= " VALUES ";
        $sql .= "(";
        $sql .= ":" .implode(",:", $keys);
        $sql .= ")";
        return $sql;
    }

    public function buildingSqlUpdate(array $data, string $model, &$sql): void {
        $keys = array_keys($data);
        $countKeys = count($keys);
        $countIteration = 0;
        $sql = "UPDATE ".$model." SET ";
        $sql .= "updated_at = NOW(), ";
        foreach ($keys as $key) {
            $countIteration = $countIteration + 1;
            $str = ', ';
            if($countIteration == $countKeys) {
               $str = '';
            }
            $sql .= $key." = :".$key.$str;
        }
    }

    public function buildingSqlDelete(array $data, string $model,  &$sql): void {
        $keys = array_keys($data);
        $countKeys = count($keys);
        $countIteration = 0;
        $sql = "UPDATE ".$model." SET ";
        $sql .= "deleted_at = NOW(), active = false, ";
        foreach ($keys as $key) {
            $countIteration = $countIteration + 1;
            $str = ', ';
            if($countIteration == $countKeys) {
                $str = '';
            }
            $sql .= $key." = :".$key.$str;
        }
    }

    public function buildingSqlWhere(string $id, &$sql): void {
        $sql .= " WHERE uuid = '" . $id."'";
    }
}