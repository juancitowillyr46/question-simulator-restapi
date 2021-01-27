<?php
namespace App\BackOffice\Security\Domain\Entities;

use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;
use stdClass;

class SecurityMapper
{
    public AutoMapperInterface $autoMapper;
    public AutoMapperConfigInterface $config;

    public function __construct(AutoMapperInterface $autoMapper)
    {
        $this->autoMapper = $autoMapper;
        $this->config = $this->autoMapper->getConfiguration();
        $this->registerMapping();
    }

    public function registerMapping()
    {
        $this->config->registerMapping(stdClass::class, LoginResponseDTO::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('fullName', function ($source) {
            return $source->fullName;
        })->forMember('email', function ($source) {
            return $source->email;
        })->forMember('roleId', function ($source) {
            return $source->roleId;
        })->forMember('roleName', function ($source) {
            return $source->roleName;
        })->forMember('planId', function ($source) {
            return $source->planId;
        })->forMember('planName', function ($source) {
            return $source->planName;
        })->forMember('id', function ($source) {
            return $source->id;
        })->forMember('planAssigned', function ($source) {
            return $source->planAssigned;
        });

    }
}