<?php
namespace App\Shared\Exception\Commands;

use Exception;

class FindAllActionException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "Resources not found";
        parent::__construct($message, $code);
    }
}