<?php
namespace App\BackOffice\Users\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UserSyncExternal extends SecurityAction
{
    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->userService->addResource((array)$bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}