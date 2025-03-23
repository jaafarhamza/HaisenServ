<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAllCategories(): Collection
    {
        return $this->model->orderBy('name')->get();
    }

    public function getMainCategories(): Collection
    {
        return $this->model->whereNull('parent_id')->orderBy('name')->get();
    }

    public function getCategoriesWithSubcategories(): Collection
    {
        return $this->model->with('subcategories')->whereNull('parent_id')->orderBy('name')->get();
    }

    public function getCategoriesWithServices(): Collection
    {
        return $this->model->with('services')->orderBy('name')->get();
    }

    public function getCategoryById(int $id): ?Category
    {
        return $this->model->find($id);
    }

    public function getCategoryBySlug(string $slug): ?Category
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function createCategory(array $data): Category
    {
        // Generate slug
        if (!isset($data['slug']) || empty($data['slug'])) {
            $slug = Str::slug($data['name']);
            $count = $this->model->where('slug', 'like', $slug . '%')->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            $data['slug'] = $slug;
        }

        return $this->model->create($data);
    }

    public function updateCategory(Category $category, array $data): bool
    {
        // Update slug if name has changed
        if (isset($data['name']) && $category->name !== $data['name'] && (!isset($data['slug']) || empty($data['slug']))) {
            $slug = Str::slug($data['name']);
            $count = $this->model->where('slug', 'like', $slug . '%')
                ->where('id', '!=', $category->id)
                ->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            $data['slug'] = $slug;
        }

        return $category->update($data);
    }

    public function deleteCategory(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function getDescendants(Category $category): Collection
    {
        $descendants = new Collection();

        foreach ($category->subcategories as $subcategory) {
            $descendants->push($subcategory);
            $childDescendants = $this->getDescendants($subcategory);
            $descendants = $descendants->merge($childDescendants);
        }

        return $descendants;
    }

    public function paginateCategories(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->query();

        // search filter
        if (isset($filters['search']) && !empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        // Filter by parent
        if (isset($filters['parent_id'])) {
            if ($filters['parent_id'] === '0') {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $filters['parent_id']);
            }
        }

        return $query->orderBy('name')->paginate($perPage);
    }
}