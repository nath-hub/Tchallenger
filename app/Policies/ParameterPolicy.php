<?php

namespace App\Policies;

use App\Models\Parameter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParameterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Parameter $parameter)
    {
        return $user->id === $parameter->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Parameter $parameter)
    {
        return $user->id === $parameter->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Parameter $parameter)
    {
        return $user->id === $parameter->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Parameter $parameter)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Parameter $parameter)
    {
        //
    }
}
