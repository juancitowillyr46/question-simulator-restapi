<?php
namespace App\Shared\Domain\Services;

use App\BackOffice\Security\Domain\Entities\LoginRequestDTO;
use App\Shared\Domain\Uuid;

interface ServiceInterface
{
    public function login(Object $loginRequestDto): Object;
    public function register(Object $registerRequestDto): Object;
    public function forgotPassword(Object $forgotRequestDto): Object;
    public function resetPassword(string $accessToken, Object $bodyRequest): Object;
    public function changePassword(string $accessToken, Object $bodyRequest): Object;
}