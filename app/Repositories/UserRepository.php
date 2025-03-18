<?php 
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAllUsers(): Collection
    {
        return $this->model->all();
    }

    public function getUserById(int $id): ?User
    {
        return $this->model->find($id);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    public function getUserByGoogleId(string $googleId): ?User
    {
        return $this->model->where('google_id', $googleId)->first();
    }

    public function createUser(array $data): User
    {
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        }
        
        return $this->model->create($data);
    }

    public function updateUser(User $user, array $data): bool
    {
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        }
        
        return $user->update($data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function findOrCreateGoogleUser(array $userData): User
    {
        $user = $this->model->where('google_id', $userData['google_id'])
            ->orWhere('email', $userData['email'])
            ->first();
            
        if (!$user) {
            return $this->createUser($userData);
        }
        
        if (!$user->google_id) {
            $this->updateUser($user, [
                'google_id' => $userData['google_id'],
                'avatar' => $userData['avatar'] ?? null,
            ]);
        }
        
        return $user;
    }
}