<?php


namespace App\BackOffice\Users\Application\Actions;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UserIsDisabled extends SecurityAction
{
    protected function action(): Response
    {
        try {
            $argId = $this->resolveArg('id');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->userService->isDisabled((array)$bodyParsed, $argId));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}