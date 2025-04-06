<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ServiceRepository implements ServiceRepositoryInterface
{
    protected $model;

    public function __construct(Service $service)
    {
        $this->model = $service;
    }

    public function getAllServices(): Collection
    {
        return $this->model->with(['user', 'category'])->orderBy('creation_date', 'desc')->get();
    }

    public function getServicesByUser(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->with('category')->orderBy('creation_date', 'desc')->get();
    }

    public function getServicesByCategory(int $categoryId): Collection
    {
        return $this->model->where('category_id', $categoryId)->with('user')->orderBy('creation_date', 'desc')->get();
    }

    public function getActiveServices(): Collection
    {
        return $this->model->where('status', 'active')->with(['user', 'category'])->orderBy('creation_date', 'desc')->get();
    }

    public function getServiceById(int $id): ?Service
    {
        return $this->model->with(['user', 'category'])->find($id);
    }

    public function getServiceBySlug(string $slug): ?Service
    {
        return $this->model->where('slug', $slug)->with(['user', 'category'])->first();
    }

    public function createService(array $data): Service
    {
        // Generate slug
        if (!isset($data['slug']) || empty($data['slug'])) {
            $slug = Str::slug($data['title']);
            $count = $this->model->where('slug', 'like', $slug . '%')->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            $data['slug'] = $slug;
        }

        // Set default creation date if not provided
        if (!isset($data['creation_date'])) {
            $data['creation_date'] = now();
        }

        return $this->model->create($data);
    }

    public function updateService(Service $service, array $data): bool
    {
        // Update slug if title has changed
        if (isset($data['title']) && $service->title !== $data['title'] && (!isset($data['slug']) || empty($data['slug']))) {
            $slug = Str::slug($data['title']);
            $count = $this->model->where('slug', 'like', $slug . '%')
                ->where('id', '!=', $service->id)
                ->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            $data['slug'] = $slug;
        }

        return $service->update($data);
    }

    public function deleteService(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function getRelatedServices(Service $service, int $limit = 4): Collection
    {
        return $this->model->where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->where('status', 'active')
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function paginateServices(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->query();

        // Join with users and categories tables for related data
        $query->with(['user', 'category']);

        // Search filter
        if (isset($filters['search']) && !empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // City filter
        if (isset($filters['city']) && !empty($filters['city'])) {
            $query->where('city', $filters['city']); 
        }
        // Category filter
        if (isset($filters['category_id']) && !empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Provider/User filter
        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        // Status filter
        if (isset($filters['status']) && !empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Price range filter
        if (isset($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }
        if (isset($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        // Sort by
        $sortField = $filters['sort_by'] ?? 'creation_date';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query->orderBy($sortField, $sortOrder);

        return $query->paginate($perPage);
    }
}