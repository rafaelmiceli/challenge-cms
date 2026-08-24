<?php

namespace App\Services;

use App\Exceptions\CategoryNotFoundException;
use App\Exceptions\CategoryHasProductsException;
use App\Models\Categoria;
use App\Repositories\Contracts\CategoriaRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoriaService
{
    public function __construct(
        protected CategoriaRepositoryInterface $repository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function findById(int $id): ?Categoria
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): Categoria
    {
        // Aquí puede ir lógica de negocio.

        return $this->repository->create($data);
    }

    public function update(int $id, array $data): Categoria
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        
        $category = $this->repository->findById($id);

        if (!$category) {
            throw new CategoryNotFoundException($id);
        }

        if ($this->repository->hasProducts($id)) {
            throw new CategoryHasProductsException($id);
        }

        return $this->repository->delete($id);
    }
}