<?php


namespace App\BackOffice\Security\Application\Actions;


use App\Shared\Action\ActionError;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ForgotPasswordAction extends SecurityAction
{
    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->securityService->forgotPassword($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex, $ex->getCode(), ActionError::UNAUTHENTICATED);
        }
    }
}