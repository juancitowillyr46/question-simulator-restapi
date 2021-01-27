<?php
namespace App\Shared\Domain\Repository;

interface RepositoryInterface
{
    public function addResource(array $request): bool;
    public function editResource(array $request, string $id): bool;
    public function removeResource(array $request, string $id): bool;
    public function readResource(string $id): object;
    public function readAllResource(array $query): object;
}