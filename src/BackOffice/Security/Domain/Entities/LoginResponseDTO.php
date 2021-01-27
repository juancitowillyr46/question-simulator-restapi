<?php


namespace App\BackOffice\Security\Domain\Entities;


class LoginResponseDTO
{
    public int $id;
    public string $email;
    public string $fullName;
    public string $token;
    public int $planId;
    public string $planName;
    public int $roleId;
    public string $roleName;
    public array $planAssigned;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getPlanId(): int
    {
        return $this->planId;
    }

    /**
     * @param int $planId
     */
    public function setPlanId(int $planId): void
    {
        $this->planId = $planId;
    }

    /**
     * @return string
     */
    public function getPlanName(): string
    {
        return $this->planName;
    }

    /**
     * @param string $planName
     */
    public function setPlanName(string $planName): void
    {
        $this->planName = $planName;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->roleName;
    }

    /**
     * @param string $roleName
     */
    public function setRoleName(string $roleName): void
    {
        $this->roleName = $roleName;
    }

    /**
     * @return array
     */
    public function getPlanAssigned(): array
    {
        return $this->planAssigned;
    }

    /**
     * @param array $planAssigned
     */
    public function setPlanAssigned(array $planAssigned): void
    {
        $this->planAssigned = $planAssigned;
    }

}