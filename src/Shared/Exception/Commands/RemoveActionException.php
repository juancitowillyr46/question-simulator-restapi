<?php
namespace App\Shared\Exception\Commands;

use Exception;

class RemoveActionException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "Resource not removed";
        parent::__construct($message, $code);
    }
}