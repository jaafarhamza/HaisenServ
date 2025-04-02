<?php

namespace App\Repositories\Interfaces;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceRepositoryInterface
{
    public function getAllServices(): Collection;
    public function getServicesByUser(int $userId): Collection;
    public function getServicesByCategory(int $categoryId): Collection;
    public function getActiveServices(): Collection;
    public function getServiceById(int $id): ?Service;
    public function getServiceBySlug(string $slug): ?Service;
    public function createService(array $data): Service;
    public function updateService(Service $service, array $data): bool;
    public function deleteService(int $id): bool;
    public function getRelatedServices(Service $service, int $limit = 4): Collection;
    public function paginateServices(int $perPage = 10, array $filters = []): LengthAwarePaginator;
}