<?php


namespace App\BackOffice\Security\Application\Actions;


use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use App\Shared\Utility\JwtCustom;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class VerifyTokenAction extends SecurityAction
{
    protected function action(): Response
    {
        try {
            $jwt = new JwtCustom();
            $accessToken = $jwt->validateAccessTokenFromHeader($this->request);
            return $this->commandSuccess($this->securityService->verifyToken($accessToken));
        } catch (Exception $ex) {
            $code = $ex->getCode();
            return $this->commandError($ex, ActionPayload::STATUS_NOT_FOUND, ActionError::UNAUTHENTICATED);
        }
    }
}