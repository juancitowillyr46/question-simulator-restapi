<?php
namespace App\BackOffice\Users\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UserRemoveAction extends SecurityAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('id');
            return $this->commandSuccess($this->userService->removeResource($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}