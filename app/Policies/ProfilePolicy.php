<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

  
    public function viewAny(User $user)
    {
        return true;
    }


    public function view(User $user, Profile $profile)
    {
        return true;
    }

  
    public function create(User $user)
    {
        return true;
    }

  
    public function update(User $user, Profile $profile)
    {
        return true;
    }

  
    public function delete(User $user, Profile $profile)
    {
        return User::find($user->id)->hasPermissionTo('delete profile');
    }

   
    public function restore(User $user, Profile $profile)
    {
        return User::find($user->id)->hasPermissionTo('edit profile');
    }

  
    public function forceDelete(User $user, Profile $profile)
    {
        return User::find($user->id)->hasPermissionTo('delete profile');
    }
}
