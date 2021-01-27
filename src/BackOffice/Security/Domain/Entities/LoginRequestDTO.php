<?php
namespace App\BackOffice\Security\Domain\Entities;

class LoginRequestDTO
{
    public string $username;
    public string $password;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function __construct(object $request)
    {
        $this->setUsername($request->username);
        $this->setPassword($request->password);
    }


}