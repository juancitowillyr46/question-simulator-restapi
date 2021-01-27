<?php


namespace App\Shared\Utility;


use App\BackOffice\Security\Domain\Entities\LoginResponseDTO;
use App\Shared\Action\ActionPayload;
use App\Shared\Exception\ValidateRequestException;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use stdClass;

class ClientHttpGuzzle
{
    protected ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }


    public string $accessToken;

    public function clientPost(string $url, array $data) {

        $body = new stdClass();

        try {

            $headers = [
                'Token'  => 'Bearer ' . $this->getAccessToken(),
                'Accept' => 'application/json',
            ];

            $response = $this->client->request('POST', $url, [
                RequestOptions::HEADERS => $headers,
                RequestOptions::JSON => $data
            ]);

            $body = json_decode($response->getBody()->getContents());

        } catch (ClientException $ex){

            $response = json_decode($ex->getResponse()->getBody()->getContents());
            throw new Exception($response->message, $ex->getResponse()->getStatusCode());

        } catch (GuzzleException $ex) {

            throw new Exception($ex->getMessage(), $ex->getCode());

        } catch (ValidateRequestException $ex) {

            throw new Exception($ex->getMessage(), $ex->getCode());

        } catch (Exception $ex) {

            throw new Exception($ex->getMessage(), $ex->getCode());
        }

        return $body;
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