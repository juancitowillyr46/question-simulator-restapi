<?php
namespace App\BackOffice\Users\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UserEditAction extends SecurityAction
{
    protected function action(): Response
    {
        try {

            $argUuid = $this->resolveArg('id');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->userService->editResource((array)$bodyParsed, $argUuid));

        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}