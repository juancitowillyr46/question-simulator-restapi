<?php
namespace App\BackOffice\Security\Domain\Entities;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Respect\Validation\Rules\NotEmpty;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class SecuritySchemaJson extends BaseValidatorRequest
{
    public function loginSchema(array $data): void {

        $messages = $this->createSchema([
            'username' => [
                new Required(),
                new Email(),
                new NotBlank()
            ],
            'password' => [
                new Required(),
                new NotBlank(),
                new Length([
                    'min' => 8,
                    'max' => 15
                ])
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }

    }

    public function registerSchema(array $data): void {

        $messages = $this->createSchema([
            'username' => [
                new Required(),
                new Email(),
                new NotBlank()
            ],
            'email' => [
                new Required(),
                new Email(),
                new NotBlank()
            ],
            'password' => [
                new Required(),
                new NotBlank(),
                new Length([
                    'min' => 6,
                    'max' => 15
                ])
            ],
            'fullname' => [
                new Required(),
                new NotBlank()
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }

    }

    public function forgotSchema(array $data): void {

        $messages = $this->createSchema([
            'username' => [
                new Required(),
                new Email(),
                new NotBlank()
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }

    }

    public function resetPasswordSchema(array $data): void {
        $messages = $this->createSchema([
            'password' => [
                new Required(),
                new NotBlank(),
                new Length([
                    'min' => 8,
                    'max' => 15
                ])
            ],
            'accessToken' => [
                new Required(),
                new NotBlank()
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }
    }

    public function changePasswordSchema(array $data): void {
        $messages = $this->createSchema([
            'oldPassword' => [
                new Required(),
                new NotBlank(),
                new Length([
                    'min' => 8,
                    'max' => 15
                ])
            ],
            'newPassword' => [
                new Required(),
                new NotBlank(),
                new Length([
                    'min' => 8,
                    'max' => 15
                ])
            ],
            'accessToken' => [
                new Required(),
                new NotBlank()
            ],
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }
    }

    public function profileSchema(array $data): void {
        $messages = $this->createSchema([
            'accessToken' => [
                new Required(),
                new NotBlank()
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }
    }
}