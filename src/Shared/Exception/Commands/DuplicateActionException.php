<?php
namespace App\Shared\Exception\Commands;


use Exception;

class DuplicateActionException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "Resource is duplicate";
        parent::__construct($message, $code);
    }
}