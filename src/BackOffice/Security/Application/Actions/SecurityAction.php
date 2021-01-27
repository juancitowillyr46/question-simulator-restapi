<?php
namespace App\BackOffice\Security\Application\Actions;


use App\BackOffice\Security\Domain\Services\SecurityService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class SecurityAction extends Action
{
    public SecurityService $securityService;

    public function __construct(
        LoggerInterface $logger,
        SecurityService $securityService
    )
    {
        $this->securityService = $securityService;
        parent::__construct($logger);
    }


}

