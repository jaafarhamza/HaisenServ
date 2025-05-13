<?php

namespace App\Services;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getPaginatedCategories(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->categoryRepository->paginateCategories($perPage, $filters);
    }

    public function getAllMainCategories(): Collection
    {
        return $this->categoryRepository->getMainCategories();
    }

    public function createCategory(array $data): Category
    {
        DB::beginTransaction();
        
        try {
            $category = $this->categoryRepository->createCategory($data);
            DB::commit();
            
            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateCategory(Category $category, array $data): bool
    {
        DB::beginTransaction();
        
        try {
            $result = $this->categoryRepository->updateCategory($category, $data);
            DB::commit();
            
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteCategory(Category $category): bool
    {
        if ($category->services()->count() > 0) {
            throw new \Exception("Cannot delete category with associated services.");
        }
        
        DB::beginTransaction();
        
        try {
            if ($category->subcategories()->count() > 0) {
                foreach ($category->subcategories as $subcategory) {
                    $subcategory->parent_id = $category->parent_id;
                    $subcategory->save();
                }
            }
            
            $result = $this->categoryRepository->deleteCategory($category->id);
            DB::commit();
            
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function canHaveAsParent(Category $category, ?int $parentId): bool
    {
        if (!$parentId) {
            return true; 
        }
        
        if ($parentId == $category->id) {
            return false; 
        }
        
        $descendants = $this->categoryRepository->getDescendants($category);
        return !$descendants->contains('id', $parentId);
    }

}