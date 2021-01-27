<?php
namespace App\BackOffice\Users\Domain\Entities;

class UserDto
{
    public string $id;
    public string $email;
    public string $username;

//    public string $firstName;
//    public string $lastName;

    public bool $active;
    public string $activeName;

    public string $roleId;
    public string $roleName;

    public string $createdAt;
    public string $blocked;
    public string $blockedName;

//    public string $fullName;
}