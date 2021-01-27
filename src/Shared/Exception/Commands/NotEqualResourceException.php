<?php


namespace App\Shared\Exception\Commands;


use Exception;

class NotEqualResourceException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "Resources no coincide con el argumento";
        parent::__construct($message, $code);
    }
}