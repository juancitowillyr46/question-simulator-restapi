<?php
namespace App\BackOffice\Users\Application\Actions;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UserFindAction extends SecurityAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('id');
            return $this->commandSuccess($this->userService->readResource($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}