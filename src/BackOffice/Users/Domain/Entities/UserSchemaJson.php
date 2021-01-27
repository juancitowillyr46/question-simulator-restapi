<?php
namespace App\BackOffice\Users\Domain\Entities;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class UserSchemaJson extends BaseValidatorRequest
{
    public function schemaAddUser(array $data): void {

        $messages = $this->createSchema([
            'firstName' => [
                new Required()
            ],
            'lastName' => [
                new Required()
            ],
            'email' => [
                new Email()
            ],
            'userName' => [
                new Required()
            ],
            'password' => [
                new Required()
            ],
            'generatePassword' => [
                new Required()
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }

    }

    public function schemaEditUser(array $data): void {
        $messages = $this->createSchema([
            'firstName' => [
                new Required()
            ],
            'lastName' => [
                new Required()
            ],
            'email' => [
                new Email()
            ],
            'userName' => [
                new Required()
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }
    }

    public function schemaAddUserExternal(array $data): void {
        $messages = $this->createSchema([
            'firstName' => [
                new Required()
            ],
            'lastName' => [
                new Required()
            ],
            'email' => [
                new Email()
            ],
            'userName' => [
                new Required()
            ],
            'password' => [
                new Required()
            ],
            'generatePassword' => [
                new Required()
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }
    }

    public function schemaStoreChangePassword(array $data): void {

        $messages = $this->createSchema([
            'password' => [
                new Required()
            ],
            'generatePassword' => [
                new Required()
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }

    }

    public function schemaStoreDisabled(array $data): void {
        $messages = $this->createSchema([
            'isDisabled' => [
                new Required()
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }
    }

}