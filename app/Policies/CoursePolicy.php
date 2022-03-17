<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    
    public function viewAny(User $user)
    {
        return true;
    }

   
    public function view(User $user, Course $Course)
    {
        return true;
    }

    
    public function create(User $user)
    {
          return $user->hasPermissionTo('create course');
    }

   
    public function update(User $user, Course $Course)
    {
        return $user->hasPermissionTo('edit course');
    }

  
    public function delete(User $user, Course $Course)
    {
        return $user->hasPermissionTo('delete course');
    }

  
    public function restore(User $user, Course $Course)
    {
        return $user->hasPermissionTo('edit course');
    }


    public function forceDelete(User $user, Course $Course)
    {
        return $user->hasPermissionTo('delete course');
    }
}
