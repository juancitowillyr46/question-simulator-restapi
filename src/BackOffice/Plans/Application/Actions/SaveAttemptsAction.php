<?php


namespace App\BackOffice\Plans\Application\Actions;


use App\Shared\Action\ActionError;
use App\Shared\Utility\JwtCustom;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class SaveAttemptsAction extends PlansAction
{

    protected function action(): Response
    {
        try {

            $jwt = new JwtCustom();
            $accessToken = $jwt->validateAccessTokenFromHeader($this->request);
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->plansService->saveAttempts($bodyParsed->assignedPlanId, $bodyParsed->examId, $accessToken));

        } catch (Exception $ex) {
            return $this->commandError($ex, $ex->getCode(), ActionError::RESOURCE_NOT_FOUND);
        }
    }
}