<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Database\QueryException;
use Image;

class ProfileController extends Controller
{
    public function index()
    {

        $profilesCollection = Profile::latest();

        if (request('search')) {
            $profilesCollection = $profilesCollection
                ->where('email', 'like', '%' . request('search') . '%')
                ->orWhere('phone', 'like', '%' . request('search') . '%');
        }

        $profiles = $profilesCollection->paginate(10);

        return view('backend.profiles.index', [
            'profiles' => $profiles
        ]);
    }

    public function create()
    {
        // $this->authorize('create-profile');

        return view('backend.profiles.create');
    }

    public function store(StoreProfileRequest $request)
    {
        try {
            Profile::create([
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $this->uploadimg(request()->file('image')),
                 'dob' => $request->dob,
            ]);

            return redirect()->route('profiles.index')->withMessage('Successfully Created!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Profile $profile)
    {
        return view('backend.profiles.show', [
            'profile' => $profile
        ]);
    }

    public function edit(Profile $profile)
    {
        return view('backend.profiles.edit', [
            'profile' => $profile
        ]);
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        try {
            $requestData = [
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                // 'image' => $this->uploadimg(request()->file('image')),
                 'dob' => $request->dob,
            ];

            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $name = time() . '.' . $img->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/profiles/');
                $img->move($destinationPath, $name);
                $profile->img = $name;
            }

            $profile->update($requestData);

            return redirect()->route('profiles.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Profile $profile)
    {
        try {
            $profile->delete();
            return redirect()->route('profiles.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    // Softdelete
    public function trash()
    {
        $profiles = Profile::onlyTrashed()->get();

        return view('backend.profiles.trashed', [
            'profiles' => $profiles
        ]);
    }

    public function restore($id)
    {
        $profile = Profile::onlyTrashed()->findOrFail($id);
        $profile->restore();
        return redirect()->route('profiles.trashed')->withMessage('Successfully Restored!');
    }

    public function delete($id)
    {
        $profile = Profile::onlyTrashed()->findOrFail($id);
        unlink(public_path('storage/profiles/' . $profile->img));
        $profile->forceDelete();
        return redirect()->route('profiles.trashed')->withMessage('Successfully Deleted Permanently!');
    }

    public function uploadimg($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        Image::make($file)
            ->resize(364, 105)
            ->save(storage_path() . '/app/public/profiles/' . $fileName);

        return $fileName;
    }
}
