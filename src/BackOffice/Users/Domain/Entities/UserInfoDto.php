<?php


namespace App\BackOffice\Users\Domain\Entities;


class UserInfoDto
{
    public string $id;
    public string $username;
    public string $email;
    public string $roleId;
    public string $roleName;
    public array $roleModules;
    public string $image;
    public string $customerId;
}
