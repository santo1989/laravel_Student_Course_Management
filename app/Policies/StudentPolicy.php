<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    
    public function view(User $user, Student $student)
    {
        return true;
    }

   
    public function create(User $user)
    {
        return $user->hasPermissionTo('create student');
    }

   
    public function update(User $user, Student $student)
    {
        return $user->hasPermissionTo('edit student');
    }

    
    public function delete(User $user, Student $student)
    {
        return $user->hasPermissionTo('delete student');
    }

   
    public function restore(User $user, Student $student)
    {
        return $user->hasPermissionTo('edit student');
    }

    
    public function forceDelete(User $user, Student $student)
    {
        return $user->hasPermissionTo('delete student');
    }
}
