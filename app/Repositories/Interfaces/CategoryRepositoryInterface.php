<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function getAllCategories(): Collection;
    public function getMainCategories(): Collection;
    public function getCategoriesWithSubcategories(): Collection;
    public function getCategoriesWithServices(): Collection;
    public function getCategoryById(int $id): ?Category;
    public function getCategoryBySlug(string $slug): ?Category;
    public function createCategory(array $data): Category;
    public function updateCategory(Category $category, array $data): bool;
    public function deleteCategory(int $id): bool;
    public function getDescendants(Category $category): Collection;
    public function paginateCategories(int $perPage = 10, array $filters = []): LengthAwarePaginator;
}