<?php
namespace App\Shared\Utility;

use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

class JwtCustom
{
    private string $exp = "+60 minutes";
    private string $secretKey = '12345678';

    public function geToken($userData): string
    {

        try {

            $now = new DateTime();
            $future = new DateTime($this->exp);

            $payload = array(
                'iat' => $now->getTimeStamp(),
                'exp' => $future->getTimeStamp(),
                'data' => $userData
            );

            return JWT::encode($payload, $this->secretKey);

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }

    }

    public function decodeToken(string $jwt): object
    {
        return JWT::decode($jwt, $this->secretKey, array('HS256'));
    }

    public function validateAccessTokenFromHeader(RequestInterface $request): string {

        if(!$request->getHeaderLine('Authorization')) {
            throw new Exception("Token Security not find");
        }

        $authorization = explode(' ', (string)$request->getHeaderLine('Authorization'));
        if(count($authorization) == 1) {
            throw new Exception("Existe el token pero no cumple con el formato");
        }

        return $authorization[1] ?? '';
    }
}