<?php


namespace App\Shared\Exception\Database;


use Exception;
use Psr\Log\LoggerInterface;

class ExceptionEloquent extends Exception
{
    //private LoggerInterface $loggerInterface;

    public function __construct($message = "", $code = 0)
    {
        //$this->loggerInterface = $loggerInterface;
//        $this->loggerInterface->error($message."|".$code);
        $message = "Existe un problema en la transacción, verifique que los datos sean correctos";
        parent::__construct($message, $code);
    }
}