<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class ServiceService
{
    protected $serviceRepository;
    protected $categoryRepository;

    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->serviceRepository = $serviceRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getPaginatedServices(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->serviceRepository->paginateServices($perPage, $filters);
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function createService(array $data): Service
    {
        DB::beginTransaction();

        try {
            $service = $this->serviceRepository->createService($data);
            DB::commit();

            return $service;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateService(Service $service, array $data): bool
    {
        DB::beginTransaction();

        try {
            $result = $this->serviceRepository->updateService($service, $data);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteService(Service $service): bool
    {
        // Check if there are any bookings for this service
        if ($service->bookings()->count() > 0) {
            throw new \Exception("Cannot delete service with associated bookings.");
        }

        DB::beginTransaction();

        try {
            $result = $this->serviceRepository->deleteService($service->id);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getServiceById(int $id): ?Service
    {
        return $this->serviceRepository->getServiceById($id);
    }

    public function validateServiceStatus(string $status): bool
    {
        $validStatuses = ['draft', 'pending', 'active', 'inactive', 'rejected'];
        return in_array($status, $validStatuses);
    }

    public function getServiceStatuses(): array
    {
        return [
            'draft' => 'Draft',
            'pending' => 'Pending Approval',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'rejected' => 'Rejected'
        ];
    }

    public function getServicesByUser(int $userId): \Illuminate\Support\Collection
    {
        return $this->serviceRepository->getServicesByUser($userId);
    }
}