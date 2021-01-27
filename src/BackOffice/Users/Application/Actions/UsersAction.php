<?php
namespace App\BackOffice\Users\Application\Actions;

use App\BackOffice\Users\Domain\Services\SecurityService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class UsersAction extends Action
{
    public SecurityService $userService;

    public function __construct(
        LoggerInterface $logger,
        SecurityService $userService
    )
    {
        $this->userService = $userService;
        parent::__construct($logger);
    }


}

