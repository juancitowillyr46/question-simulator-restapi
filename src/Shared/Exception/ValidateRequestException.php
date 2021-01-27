<?php
namespace App\Shared\Exception;

use Exception;

class ValidateRequestException extends Exception
{
    public function __construct($message = "", $code = 1500) {
        parent::__construct($message, $code);
    }
}