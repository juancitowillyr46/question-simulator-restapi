<?php

namespace App\Shared\Domain;

use Ramsey\Uuid\Uuid as UuidGenerate;

class Uuid
{
    public string $uuid;

    public function __construct()
    {

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

}