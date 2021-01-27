<?php


namespace App\BackOffice\Plans\Domain\Services;


use App\Shared\Action\ActionPayload;
use App\Shared\Utility\ClientHttpGuzzle;
use Exception;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\RequestInterface;
use stdClass;

class PlansService implements PlansServiceInterface
{
    protected ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function saveAttempts(int $assignedPlanId, int $examId, string $accessToken): object {
        $body = new stdClass();

//        "accessToken"    => $accessToken
        try {
            $clientHttpGuzzle = new ClientHttpGuzzle($this->client);
            $clientHttpGuzzle->setAccessToken($accessToken);
            $body = $clientHttpGuzzle->clientPost('attempts', array(
                "assignedPlanId" => $assignedPlanId,
                "examId"         => $examId
            ));
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

        return $body;
    }
}