<?php
namespace App\Shared\Action;

use App\Shared\Domain\Services\BaseService;
use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

abstract class Action
{
    protected LoggerInterface $logger;
    protected Request $request;
    protected Response $response;
    protected array $args;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {

        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (HttpNotFoundException $e) {
            $this->logger->error($e->getMessage());
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }


    }

    abstract protected function action(): Response;

    protected function getFormData()
    {
        $input = json_decode(file_get_contents('php://input'));

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    protected function respondWithData($data = null, int $statusCode = 200): Response
    {
        $payload = new ActionPayload($statusCode, $data);

        return $this->respond($payload);
    }

    protected function respond(ActionPayload $payload): Response
    {
        // JSON_PRETTY_PRINT
        // JSON_PARTIAL_OUTPUT_ON_ERROR
        $json = json_encode($payload, JSON_PARTIAL_OUTPUT_ON_ERROR);
        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($payload->getStatusCode());
    }

    public function commandSuccess($data): Response {
        try {

            return $this->respondWithData($data);

        } catch (Exception $e) {

            $message = $e->getMessage();

            if($e->getCode() === 1500){
                $message = json_decode($e->getMessage(), JSON_PRETTY_PRINT);
            }

            $error = new ActionError(ActionError::BAD_REQUEST, $message);
            $payLoad = new ActionPayload(ActionPayload::STATUS_NOT_FOUND, null, $error);
            return $this->respond($payLoad);

        }
    }

    public function commandError(Exception $e, int $statusCode = ActionPayload::STATUS_NOT_FOUND, string $messageError = ActionError::BAD_REQUEST): Response {

        $message = $e->getMessage();
        $code = $e->getCode();

        $this->logger->error($e->getMessage()."|".$e->getCode());

        if($code == 1500)
            $message = json_decode($e->getMessage(), JSON_PRETTY_PRINT);
            $statusCode = ActionPayload::STATUS_NOT_FOUND;

        if($code == '23000' || $code == '42S02' || $code == '42S22')
            $message = 'Error SQL';


        $error = new ActionError($messageError, $message);
        $payLoad = new ActionPayload($statusCode, null, $error);


        return $this->respond($payLoad);
    }

}