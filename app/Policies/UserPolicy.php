<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    private const AdminEmailMd5 = 'acc4c0e8f20667a1bffd79c1bd516f0c';

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): ?bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): ?bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): ?bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): ?bool
    {
        return !(md5($model->email) === self::AdminEmailMd5 && md5($user->email) !== self::AdminEmailMd5);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): ?bool
    {
        return $user->id !== $model->id && md5($model->email) !== self::AdminEmailMd5;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): ?bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): ?bool
    {
        return true;
    }
}
