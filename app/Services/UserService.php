<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceInterface
{

    /**
     * Retrieve all resources and paginate.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list()
    {
        return User::orderBy('id', 'DESC')->paginate(10);
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
        return User::create($attributes);
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
        return User::findOrFail($id);
    }

    /**
     * Update model resource.
     *
     * @param  User  $user
     * @param  array   $attributes
     * @return boolean
     */
    public function update(User $user, array $attributes): bool
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
        return $user->update($attributes);
    }

    /**
     * Soft delete model resource.
     *
     * @param  User  $user
     * @return void
     */
    public function destroy(User $user)
    {
        $user->delete();
    }


    /**
     * Include only soft deleted records in the results.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listTrashed()
    {
        return User::onlyTrashed()->paginate(10);
    }

    /**
     * Restore model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function restore($id)
    {

        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
    }

    /**
     * Permanently delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function delete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
    }


    /**
     * Upload the given file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        // Upload avatar
        $avatar = $file->store('avatars', ['disk' => 'public']);
        return "storage/$avatar";
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
