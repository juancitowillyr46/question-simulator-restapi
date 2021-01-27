<?php
namespace App\BackOffice\Users\Application\Actions;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UserFindAllAction extends SecurityAction
{
    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            return $this->commandSuccess($this->userService->readAllResource($query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}