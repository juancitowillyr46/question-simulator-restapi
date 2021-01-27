<?php


namespace App\Shared\Exception\Commands;


use Exception;

class EditVerifiedArgActionException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "El argumento no coincide";
        parent::__construct($message, $code);
    }
}