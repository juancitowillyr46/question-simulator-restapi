<?php


namespace App\BackOffice\Security\Domain\Entities;


class ForgotPasswordRequestDTO
{
    public string $username;
    public string $accessToken;

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

    public function __construct(object $request)
    {
        $this->setUsername($request->username);
        $this->setAccessToken($request->accessToken);
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }


}