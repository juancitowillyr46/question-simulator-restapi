<?php
namespace App\BackOffice\Users\Domain\Entities;

use App\Shared\Domain\Entities\Audit;
use App\Shared\Utility\SecurityPassword;
use Exception;
use Ramsey\Uuid\Uuid;

class UserEntity extends Audit
{
    public string $first_name;
    public string $last_name;
    public string $username;
    public string $email;
    public string $password;
    public int $role_id;
    public bool $is_disabled;
    public bool $is_change_password;
    public bool $is_send_email;
    public bool $sign_in_at;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

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

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     */
    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
    }


    /**
     * @return bool
     */
    public function isIsDisabled(): bool
    {
        return $this->is_disabled;
    }

    /**
     * @param bool $is_disabled
     */
    public function setIsDisabled(bool $is_disabled): void
    {
        $this->is_disabled = $is_disabled;
    }

    /**
     * @return bool
     */
    public function isIsChangePassword(): bool
    {
        return $this->is_change_password;
    }

    /**
     * @param bool $is_change_password
     */
    public function setIsChangePassword(bool $is_change_password): void
    {
        $this->is_change_password = $is_change_password;
    }

    /**
     * @return bool
     */
    public function isIsSendEmail(): bool
    {
        return $this->is_send_email;
    }

    /**
     * @param bool $is_send_email
     */
    public function setIsSendEmail(bool $is_send_email): void
    {
        $this->is_send_email = $is_send_email;
    }

    /**
     * @return bool
     */
    public function isSignInAt(): bool
    {
        return $this->sign_in_at;
    }

    /**
     * @param bool $sign_in_at
     */
    public function setSignInAt(bool $sign_in_at): void
    {
        $this->sign_in_at = $sign_in_at;
    }

    /*public function payload(object $formData): void {

        try {

            $validate = new SecuritySchemaJson();
            $validate->schemaAddResource((array)$formData);

            $this->identifiedResource($formData);



//            if(!property_exists($formData, "id")) {
//                $this->setPassword(SecurityPassword::encryptPassword($formData->password));
//            }

//            $this->setUsername($formData->username);
//            $this->setEmail($formData->email);
//            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }*/

}