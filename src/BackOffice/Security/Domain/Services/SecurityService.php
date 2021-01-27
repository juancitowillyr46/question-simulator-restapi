<?php
namespace App\BackOffice\Security\Domain\Services;

use App\BackOffice\Security\Domain\Entities\ChangePasswordRequestDTO;
use App\BackOffice\Security\Domain\Entities\ForgotPasswordRequestDTO;
use App\BackOffice\Security\Domain\Entities\LoginRequestDTO;
use App\BackOffice\Security\Domain\Entities\LoginResponseDTO;
use App\BackOffice\Security\Domain\Entities\ResetPasswordRequestDTO;
use App\BackOffice\Security\Domain\Entities\SecuritySchemaJson;
use App\BackOffice\Security\Domain\Entities\RegisterRequestDTO;
use App\BackOffice\Security\Domain\Entities\SecurityMapper;
use App\Shared\Action\ActionPayload;
use App\Shared\Domain\Services\ServiceInterface;
use App\Shared\Exception\ValidateRequestException;
use App\Shared\Utility\ClientHttpGuzzle;
use App\Shared\Utility\JwtCustom;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use stdClass;

class SecurityService implements ServiceInterface
{
      protected SecurityMapper $securityMapper;
      protected SecuritySchemaJson $securitySchemaJson;
      protected ClientInterface $client;

      public function __construct(SecurityMapper $securityMapper, SecuritySchemaJson $securitySchemaJson, ClientInterface $client)
      {
          $this->securityMapper = $securityMapper;
          $this->securitySchemaJson = $securitySchemaJson;
          $this->client = $client;
      }

    public function login(Object $loginRequestDto): Object
    {
        $body = new stdClass();
        $statusCode = 200;
        $message = '';

        try {

            $this->securitySchemaJson->loginSchema((array)$loginRequestDto);

            $loginRequestDto = new LoginRequestDTO($loginRequestDto);

            $data = (array) $loginRequestDto;

            $response = $this->client->request('POST', 'login', [
               RequestOptions::JSON => $data
            ]);

            $statusCode = $response->getStatusCode();

            $body = json_decode($response->getBody()->getContents());

        } catch (ClientException $ex){

            $statusCode = $ex->getResponse()->getStatusCode();
            $response = json_decode($ex->getResponse()->getBody()->getContents());
            $message = $response->message;

        } catch (GuzzleException $ex) {

            $statusCode = $ex->getCode();
            $message = $ex->getMessage();

        } catch (ValidateRequestException $ex) {

            $statusCode = $ex->getCode();
            $message = $ex->getMessage();
        }

        if($statusCode != 200) {
            throw new Exception($message, ActionPayload::STATUS_UNAUTHORIZED);
        } else {
            $user = $body->object;
            $jwt = new JwtCustom();
            $token = $jwt->geToken(
                array(
                    'id'        => $user->id,
                    'email'     => $user->email,
                    'fullName'  => $user->fullName,
                    'roleGroup' => $user->role->roleId,
                    'planId'    => $user->plan->id,
                    'planName'  => $user->plan->name
                )
            );
            $user->token = $token;
            return $user;
            //return $this->securityMapper->autoMapper->map($user, LoginResponseDTO::class);
        }

    }

    public function register(Object $registerRequestDto): Object
    {
        $body = new stdClass();
        $statusCode = 200;
        $message = '';

        try {

            $this->securitySchemaJson->registerSchema((array)$registerRequestDto);

            $registerRequestDto = new RegisterRequestDTO($registerRequestDto);

            $response = $this->client->request('POST', 'register', [
                RequestOptions::JSON => $registerRequestDto
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody()->getContents());

        } catch (ClientException $ex){

            $statusCode = $ex->getResponse()->getStatusCode();
            $response = json_decode($ex->getResponse()->getBody()->getContents());
            $message = $response->message;

        } catch (GuzzleException $ex) {

            $statusCode = $ex->getCode();
            $message = $ex->getMessage();

        } catch (ValidateRequestException $ex) {

            $statusCode = $ex->getCode();
            $message = $ex->getMessage();
        }

        if($statusCode != 200) {
            throw new Exception($message, ActionPayload::STATUS_UNAUTHORIZED);
        } else {
            return $body;
        }
    }

    public function forgotPassword(Object $forgotPasswordRequestDto): Object
    {

        $body = new stdClass();

        try {

            $this->securitySchemaJson->forgotSchema((array)$forgotPasswordRequestDto);

            $clientHttpGuzzle = new ClientHttpGuzzle($this->client);
            $clientHttpGuzzle->setAccessToken('');
            $body = $clientHttpGuzzle->clientPost('forgotpassword', array('username' => $forgotPasswordRequestDto->username));

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

        return $body;

    }

    public function resetPassword(string $accessToken, Object $bodyRequest): Object
    {
        $body = new stdClass();

        try {
            $clientHttpGuzzle = new ClientHttpGuzzle($this->client);
            $clientHttpGuzzle->setAccessToken($accessToken);
            $body = $clientHttpGuzzle->clientPost('resetpassword', (array) $bodyRequest);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), ActionPayload::STATUS_UNAUTHORIZED);
        }

        return $body;
    }

    public function changePassword(string $accessToken, Object $bodyRequest): Object {

        $body = new stdClass();

        try {
            $clientHttpGuzzle = new ClientHttpGuzzle($this->client);
            $clientHttpGuzzle->setAccessToken($accessToken);
            $body = $clientHttpGuzzle->clientPost('changepassword', (array) $bodyRequest);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

        return $body;

    }

    public function getProfile(string $accessToken) {

        $body = new stdClass();

        try {
            $clientHttpGuzzle = new ClientHttpGuzzle($this->client);
            $clientHttpGuzzle->setAccessToken($accessToken);
            $body = $clientHttpGuzzle->clientPost('profile', array());
        } catch (Exception $ex) {
            throw new Exception('', ActionPayload::STATUS_UNAUTHORIZED);
        }

        return $body->object;

    }

    public function verifyToken(string $accessToken) {

        $body = new stdClass();

        try {
            $clientHttpGuzzle = new ClientHttpGuzzle($this->client);
            $clientHttpGuzzle->setAccessToken($accessToken);
            $body = $clientHttpGuzzle->clientPost('verifytoken', array());
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), ActionPayload::STATUS_UNAUTHORIZED);
        }

        return $body;

    }
}