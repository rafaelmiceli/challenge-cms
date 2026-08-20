<?php

namespace App\Repositories\Contracts;

use App\Models\Articulo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ArticuloRepositoryInterface
{
    public function getAll(): Collection;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): ?Articulo;

    public function create(array $data): Articulo;

    public function update(int $id, array $data): Articulo;

    public function delete(int $id): bool;
}