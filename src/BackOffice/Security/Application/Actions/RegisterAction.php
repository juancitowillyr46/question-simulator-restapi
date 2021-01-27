<?php
namespace App\BackOffice\Security\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class RegisterAction extends SecurityAction
{
    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->securityService->register($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}