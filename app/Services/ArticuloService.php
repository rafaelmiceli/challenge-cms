<?php

namespace App\Services;

use App\Models\Articulo;
use App\Repositories\Contracts\ArticuloRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticuloService
{
    public function __construct(
        protected ArticuloRepositoryInterface $repository
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

    public function findById(int $id): ?Articulo
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): Articulo
    {
        // Aquí puede ir lógica de negocio.
        $data['user_id'] = auth()->id();
        
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): Articulo
    {
        $data['user_id'] = auth()->id();
        
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}