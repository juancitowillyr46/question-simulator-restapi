<?php
namespace App\BackOffice\Security\Domain\Entities;

use App\Shared\Domain\Entities\Audit;
use App\Shared\Utility\SecurityPassword;
use Exception;
use Ramsey\Uuid\Uuid;

class RegisterRequestDTO
{
    public string $username;
    public string $fullname;
    public string $password;
    public string $email;

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
    public function getFullname(): string
    {
        return $this->fullname;
    }

    /**
     * @param string $fullname
     */
    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
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

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function __construct(object $request)
    {
        $this->setUsername($request->username);
        $this->setEmail($request->email);
        $this->setFullname($request->fullname);
        $this->setPassword($request->password);
    }

}