<?php
namespace App\Shared\Exception\Commands;

use Exception;

class FindActionException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "Resource not found";
        parent::__construct($message, $code);
    }
}