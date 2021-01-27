<?php
namespace App\Shared\Exception;

use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use Exception;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseValidatorRequest
{
    public ValidatorInterface $createValidator;

    public function __construct()
    {
        $this->createValidator = Validation::createValidator();
    }

    public function createSchema($options, $data): array {

        $constraint = new Collection($options);

        $groups = new GroupSequence(['Default', 'custom']);

        $messages = [];

        $validations = $this->createValidator->validate((array) $data, $constraint, $groups);

        if(count($validations) > 0) {
            foreach($validations as $validation) {
                $messages[] = $validation->getPropertyPath() .": ".$validation->getMessage();
            }
        }

        return $messages;
    }

    //abstract function getMessages(array $data): array;

}