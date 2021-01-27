<?php
namespace App\BackOffice\Security\Domain\Entities;

use App\Shared\Domain\Entities\Audit;
use App\Shared\Utility\SecurityPassword;
use Exception;
use Ramsey\Uuid\Uuid;

class RegisterResponseDTO
{
    public string $username;
    public string $fullName;
    public string $password;
    public string $email;
}