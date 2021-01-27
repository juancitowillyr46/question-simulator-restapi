<?php


namespace App\BackOffice\Security\Application\Actions;


use App\Shared\Action\ActionError;
use App\Shared\Utility\JwtCustom;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ChangePasswordAction extends SecurityAction
{
    protected function action(): Response
    {
        try {

            $jwt = new JwtCustom();

            $accessToken = $jwt->validateAccessTokenFromHeader($this->request);

            $bodyParsed = $this->getFormData();

            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->securityService->changePassword($accessToken, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex, $ex->getCode(), ActionError::RESOURCE_NOT_FOUND);
        }
    }
}