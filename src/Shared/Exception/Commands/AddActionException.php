<?php
namespace App\Shared\Exception\Commands;

use Exception;

class AddActionException extends Exception
{
    public function __construct($message = "Resource not added", $code = 0) {
//        $message = "Resource not added";
        parent::__construct($message, $code);
    }
}