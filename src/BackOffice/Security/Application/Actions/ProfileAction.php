<?php


namespace App\BackOffice\Security\Application\Actions;


use App\Shared\Action\ActionError;
use App\Shared\Utility\JwtCustom;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProfileAction extends SecurityAction
{
    protected function action(): Response
    {
        try {

            $jwt = new JwtCustom();

            $accessToken = $jwt->validateAccessTokenFromHeader($this->request);

            return $this->commandSuccess($this->securityService->getProfile($accessToken));
        } catch (Exception $ex) {
            return $this->commandError($ex, $ex->getCode(), ActionError::UNAUTHENTICATED);
        }
    }
}