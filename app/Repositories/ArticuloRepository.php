<?php

namespace App\Repositories;

use App\Models\Articulo;
use App\Repositories\Contracts\ArticuloRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticuloRepository implements ArticuloRepositoryInterface
{
    public function __construct(
        protected Articulo $model
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

    public function findById(int $id): ?Articulo
    {
        return $this->model->find($id);
    }

    public function create(array $data): Articulo
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Articulo
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
}