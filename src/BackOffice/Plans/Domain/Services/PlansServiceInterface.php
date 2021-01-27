<?php


namespace App\BackOffice\Plans\Domain\Services;


interface PlansServiceInterface
{
    public function saveAttempts(int $assignedPlanId, int $examId, string $accessToken): object;
}