<?php
namespace App\Shared\Domain\Entities;

use App\Shared\Domain\ResponseDataId;
use App\Shared\Domain\Uuid;
use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid as UuidGenerate;

class Audit
{
    public string $uuid;
    public int $id;
    public string $created_at;
    public string $created_by;
    public string $updated_at;
    public string $updated_by;
    public string $deleted_at;
    public string $deleted_by;
    public bool $active;
    public ResponseDataId $responseDataId;

    /**
     * @return ResponseDataId
     */
    public function getResponseDataId(): ResponseDataId
    {
        $uuid = new ResponseDataId();
        $uuid->setId($this->uuid);
        return $uuid;
    }

    /**
     * @param ResponseDataId $responseDataId
     */
    public function setResponseDataId(ResponseDataId $responseDataId): void
    {
        $this->responseDataId = $responseDataId;
    }



    public function __construct()
    {
//        $this->setId(0);
//        $this->setActive(true);
//        $this->setCreatedAt(date('Y-m-d H:m:s'));
//        $this->setCreatedBy('ADMIN');
//        $this->setDeletedAt('');
//        $this->setDeletedBy('');
//        if($this->getUuid() == "") {
//            $this->setUuid(UuidGenerate::uuid1());
//        } else {
//            $this->setUpdatedAt(date('Y-m-d H:m:s'));
//            $this->setUpdatedBy('ADMIN');
//
//        }
//        $this->setUuid(UuidGenerate::uuid1());
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }



    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->created_by;
    }

    /**
     * @param string $created_by
     */
    public function setCreatedBy(string $created_by): void
    {
        $this->created_by = $created_by;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string
     */
    public function getUpdatedBy(): string
    {
        return $this->updated_by;
    }

    /**
     * @param string $updated_by
     */
    public function setUpdatedBy(string $updated_by): void
    {
        $this->updated_by = $updated_by;
    }

    /**
     * @return string
     */
    public function getDeletedAt(): string
    {
        return $this->deleted_at;
    }

    /**
     * @param string $deleted_at
     */
    public function setDeletedAt(string $deleted_at): void
    {
        $this->deleted_at = $deleted_at;
    }

    /**
     * @return string
     */
    public function getDeletedBy(): string
    {
        return $this->deleted_by;
    }

    /**
     * @param string $deleted_by
     */
    public function setDeletedBy(string $deleted_by): void
    {
        $this->deleted_by = $deleted_by;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /*public function setAuditUpdate() {
        $this->setUpdatedAt(date('Y-m-d H:i:s'));
        $this->setUpdatedBy('ADMIN');
    }

    public function setAuditCreate() {
        $this->setCreatedAt(date('Y-m-d H:i:s'));
        $this->setCreatedBy('ADMIN');
        $this->setUpdatedBy('');
    }*/

//    public function identifiedResource(object $formData): void {
//        if(!property_exists($formData, "id")) {
//            $this->setAuditCreate();
//        } else {
//            $this->setUuid((!property_exists($formData, "id"))? \Ramsey\Uuid\Uuid::uuid1() : $formData->id);
//            $this->setAuditUpdate();
//        }
//
//    }



}