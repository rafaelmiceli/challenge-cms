<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{

    public function __construct(
        protected User $model
    ) {
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model::query()
            ->latest()
            ->paginate($perPage);
    }

    public function findById(int $id): ?User
    {
        return $this->model::find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model::where('email', $email)->first();
    }

    public function create(array $data): User
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data): User
    {

        $model = $this->model->findOrFail($id);

        $model->update($data);

        return $this->model->refresh();
    }

    public function delete(int $id): bool
    {

        $model = $this->model->findOrFail($id);

        return (bool) $model->delete();
    }

    public function countAdmins(): int
    {
        return $this->model::where('role', 'admin')->count();
    }
}