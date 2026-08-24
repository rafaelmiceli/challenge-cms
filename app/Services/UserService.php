<?php

namespace App\Services;

use App\Models\User;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserAlreadyExistsException;
use App\Exceptions\CannotDeleteLastAdminException;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function find(int $id): User
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            throw new UserNotFoundException($id);
        }

        return $user;
    }

    public function create(array $data): User
    {
        $existingUser = $this->repository
            ->findByEmail($data['email']);

        if ($existingUser) {
            throw new UserAlreadyExistsException(
                $data['email']
            );
        }

        return $this->repository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'] ?? 'user',
        ]);
    }

    public function update(int $id, array $data): User
    {
        $user = $this->find($id);

        if (!$user) {
            throw new UserNotFoundException($id);
        }

        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $user = $this->find($id);

        if (
            $user->isAdmin() &&
            $this->repository->countAdmins() <= 1
        ) {
            throw new CannotDeleteLastAdminException();
        }

        return $this->repository->delete($id);
    }
}