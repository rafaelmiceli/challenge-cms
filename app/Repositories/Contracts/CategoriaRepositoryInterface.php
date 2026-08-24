<?php

namespace App\Repositories\Contracts;

use App\Models\Categoria;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CategoriaRepositoryInterface
{
    public function getAll(): Collection;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): ?Categoria;

    public function create(array $data): Categoria;

    public function update(int $id, array $data): Categoria;

    public function delete(int $id): bool;
    
    public function hasProducts(int $id): bool;
}