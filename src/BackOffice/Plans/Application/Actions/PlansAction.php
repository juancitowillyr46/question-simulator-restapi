<?php


namespace App\BackOffice\Plans\Application\Actions;


use App\BackOffice\Plans\Domain\Services\PlansService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class PlansAction extends Action
{
    public PlansService $plansService;

    public function __construct(
        LoggerInterface $logger,
        PlansService $securityService
    )
    {
        $this->plansService = $securityService;
        parent::__construct($logger);
    }
}