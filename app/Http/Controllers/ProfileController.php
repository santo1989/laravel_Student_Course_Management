<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
 
    public function index()
    {
        $profiles = Profile::all();
        return view('backend.profiles.index', compact('profiles'));
    }

 
    public function create()
    {
        return view('backend.profiles.create');
    }

  
    public function store(StoreProfileRequest $request)
    {
        Profile::create($request->all());

        return redirect()->route('profiles.index')
                        ->with('success','Profile created successfully');
    }

    public function show(Profile $profile)
    {
        return view('backend.profiles.show', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        return view('backend.profiles.edit', compact('profile'));
    }

   
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $profile->update($request->all());

        return redirect()->route('backend.profiles.index')
                        ->with('success','Profile updated successfully');
    }


    public function destroy(Profile $profile)
    {
        $profile=Profile::find($profile->id);
        $profile->delete();
        return redirect()->route('backend.profiles.index')
                        ->with('success','Profile deleted successfully');
    }
}
