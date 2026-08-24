<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Repositories\Contracts\CategoriaRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoriaRepository implements CategoriaRepositoryInterface
{
    public function __construct(
        protected Categoria $model
    ) {
    }

    public function getAll(): Collection
    {
        return $this->model
            ->orderBy('id', 'desc')
            ->get();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function findById(int $id): ?Categoria
    {
        return $this->model->find($id);
    }

    public function create(array $data): Categoria
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Categoria
    {
        $articulo = $this->model->findOrFail($id);

        $articulo->update($data);

        return $articulo->refresh();
    }

    public function delete(int $id): bool
    {
        $articulo = $this->model->findOrFail($id);

        return (bool) $articulo->delete();
    }

    public function hasProducts(int $id): bool
    {
        return $this->model::whereKey($id)
            ->whereHas('articulos')
            ->exists();
    }
}