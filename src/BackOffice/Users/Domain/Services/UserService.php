<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\RegisterDTO;
use App\BackOffice\Users\Domain\Entities\SecurityMapper;

use App\BackOffice\Users\Domain\Entities\UserSchemaJson;
use App\BackOffice\Users\Infrastructure\Persistence\UserRepository;

use App\Shared\Domain\Services\ServiceInterface;

use App\Shared\Utility\SecurityPassword;
use App\Shared\Utility\WebConstants;
use Exception;
use stdClass;
use Ramsey\Uuid\Uuid as UuidGenerate;

class UserService implements ServiceInterface
{
      protected RegisterDTO $userEntity;
      protected UserRepository $userRepository;
      protected SecurityMapper $userMapper;
      protected UserSchemaJson $userSchemaJson;

      public function __construct(UserRepository $userRepository, RegisterDTO $userEntity, SecurityMapper $userMapper, UserSchemaJson $userSchemaJson)
      {
          $this->userEntity = $userEntity;
          $this->userRepository = $userRepository;
          $this->userMapper = $userMapper;
          $this->userSchemaJson = $userSchemaJson;
      }

    public function addResource(array $request): object
    {
        try {

            $this->userSchemaJson->schemaAddUser($request);

            $this->isDuplicateEmailInAdd($request['email']);

            $newPassword = '';
            if($request['generatePassword'] == true) {
                $newPassword = SecurityPassword::generatePassword(8);
            } else {
                $newPassword = $request['password'];
            }

            $userEntity = new RegisterDTO();
            $userEntity->setUuid(UuidGenerate::uuid1());
            $userEntity->setFirstName($request['firstName']);
            $userEntity->setLastName($request['lastName']);
            $userEntity->setEmail($request['email']);
            $userEntity->setUsername($request['userName']);
            $userEntity->setPassword(SecurityPassword::encryptPassword($newPassword));
            $userEntity->setRoleId(WebConstants::ROLE_ID);
            $userEntity->setIsDisabled(WebConstants::IS_DISABLED);
            $userEntity->setIsChangePassword(WebConstants::IS_CHANGE_PASSWORD);
            $userEntity->setIsSendEmail(WebConstants::IS_SEND_EMAIL);
            $userEntity->setActive(WebConstants::ACTIVE);

            $operationResult = new stdClass();
            $operationResult->message = WebConstants::MSG_USER_ADD;
            $operationResult->type = ($this->userRepository->addResource((array) $userEntity))? 'OK' : 'ERROR';
            return $operationResult;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function editResource(array $request, string $id): object
    {
        try {

            $this->userSchemaJson->schemaEditUser($request);

            $this->searchUserById($id);

            $this->isDuplicateEmailInEdit($request['email'], $id);

            $userEntity = new RegisterDTO();
            $userEntity->setFirstName($request['firstName']);
            $userEntity->setLastName($request['lastName']);
            $userEntity->setEmail($request['email']);
            $userEntity->setUsername($request['userName']);
            $userEntity->setUpdatedBy('ADMIN');

            $operationResult = new stdClass();
            $operationResult->message = WebConstants::MSG_USER_EDIT;
            $operationResult->type = ($this->userRepository->editResource((array) $userEntity, $id))? 'OK' : 'ERROR';
            return $operationResult;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function removeResource(string $id): object
    {
        try {

            $this->searchUserById($id);

            $userEntity = new RegisterDTO();
            $userEntity->setDeletedBy('ADMIN');

            $operationResult = new stdClass();
            $operationResult->message = WebConstants::MSG_USER_REMOVE;
            $operationResult->type = ($this->userRepository->removeResource((array) $userEntity, $id))? 'OK' : 'ERROR';
            return $operationResult;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function readResource(string $id): object
    {
        return $this->userRepository->readResource($id);
    }

    public function readAllResource(array $query): object
    {
        return $this->userRepository->readAllResource($query);
    }

    public function changePassword(array $request, string $id) {
        try {

            $this->userSchemaJson->schemaStoreChangePassword($request);

            $this->searchUserById($id);

            $userEntity = new RegisterDTO();
            $newPassword = '';
            if($request['generatePassword'] == true) {
                $newPassword = SecurityPassword::generatePassword(8);
            } else {
                $newPassword = $request['password'];
            }
            $userEntity->setUpdatedBy('ADMIN');
            $userEntity->setPassword(SecurityPassword::encryptPassword($newPassword));
            $operationResult = new stdClass();
            $operationResult->message = WebConstants::MSG_USER_CHANGE_PASSWORD;
            $operationResult->type = ($this->userRepository->editResource((array) $userEntity, $id))? 'OK' : 'ERROR';
            return $operationResult;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function isDisabled(array $request, string $id) {
        try {

            $this->userSchemaJson->schemaStoreDisabled($request);

            $this->searchUserById($id);

            $userEntity = new RegisterDTO();
            $userEntity->setIsDisabled($request['isDisabled']);
            $operationResult = new stdClass();
            $operationResult->message = WebConstants::MSG_USER_IS_DISABLED;
            $operationResult->type = ($this->userRepository->editResource((array) $userEntity, $id))? 'OK' : 'ERROR';
            return $operationResult;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function isDuplicateEmailInAdd(string $email): void {
      if($this->userRepository->isDuplicateEmailInAdd($email)) {
          throw new Exception(WebConstants::MSG_USER_VALIDATE);
      }
    }

    public function isDuplicateEmailInEdit(string $email, string $id): void {
        if($this->userRepository->isDuplicateEmailInEdit($email, $id)) {
            throw new Exception(WebConstants::MSG_USER_VALIDATE_IN_EDIT);
        }
    }

    public function searchUserById(string $id): void {
        if(!$this->userRepository->searchUserById($id)) {
            throw new Exception(WebConstants::MSG_USER_NOT_EXIST);
        }
    }



}