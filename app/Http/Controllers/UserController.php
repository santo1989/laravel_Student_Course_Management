<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $usersCollection = User::latest();

        if (request()->has('role_id')) {
            $usersCollection = $usersCollection
                ->where('role_id', request('role_id'));
        }

        if (request('search')) {
            $usersCollection = $usersCollection
                ->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%');
        }

        $users = $usersCollection->paginate(10);
        // dd($users);
        $roles = Role::all();

        return view('backend.users.index', [
            'users' => $users,
            'roles' => $roles,

        ]);
    }

    public function details(User $user)
    {
        return view('backend.users.details', [
            'user' => $user
        ]);
    }

    public function show(User $user)
    {
        return view('backend.users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        return view('backend.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, User $user)
    {
        try {

            $requestData = [
                'role_id' => $request->role_id
            ];

            $user->update($requestData);

            return redirect()->route('users.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
