<?php
namespace App\Shared\Exception\Commands;

use Exception;

class EditActionException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "Resource not edit";
        parent::__construct($message, $code);
    }
}