<?php

namespace App\Services;

use App\Models\Profile;
use App\Traits\UploadAvatar;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\UserRepositoryInterface;

class UserService implements UserServiceInterface
{

    use UploadAvatar;

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Retrieve all resources and paginate.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list()
    {
        return $this->userRepository->allUsers();
    }

    /**
     * Create model resource.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes): Model
    {

        if (isset($attributes['avatar'])) {
            $attributes['photo'] = $this->upload($attributes['avatar']);
        }

        $attributes['password'] = $this->hash($attributes['password']);

        // Create user
        $user = $this->userRepository->createUser($attributes);

        // Update details
        if (isset($attributes['country'])) {
            $user->profile()->updateOrCreate(['country' => $attributes['country']]);
        }

        return $user;
    }

    /**
     * Retrieve model resource details.
     * Abort to 404 if not found.
     *
     * @param  integer $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        return $this->userRepository->getUserById($id);
    }

    /**
     * Update model resource.
     *
     * @param  int  $id
     * @param  array   $attributes
     * @return boolean
     */
    public function update(int $id, array $attributes): bool
    {

        if (isset($attributes['avatar'])) {
            $attributes['photo'] = $this->upload($attributes['avatar']);
        }

        if (empty($attributes['password'])) {
            unset($attributes['password']);
        } else {
            $attributes['password'] = $this->hash($attributes['password']);
        }

        // Update user       
        $update = $this->userRepository->updateUser($id, $attributes);

        // Update details
        if (isset($attributes['country'])) {
            Profile::updateOrCreate(['user_id' => $id], ['country' => $attributes['country']]);
        }
        return $update;
    }

    /**
     * Soft delete model resource.
     *
     * @param  int  $id
     * @return void
     */
    public function destroy(int $id)
    {
        return $this->userRepository->destroyUser($id);
    }


    /**
     * Include only soft deleted records in the results.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listTrashed()
    {
        return $this->userRepository->trashedUsers();
    }

    /**
     * Restore model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function restore($id)
    {
        return $this->userRepository->restoreTrashedUser($id);
    }

    /**
     * Permanently delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function delete($id)
    {
        return $this->userRepository->permanentlyDeleteUser($id);
    }


    /**
     * Generate random hash key.
     *
     * @param  string $password
     * @return string
     */
    public function hash(string $password)
    {
        return bcrypt($password);
    }
}
