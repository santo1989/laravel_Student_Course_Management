<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Database\QueryException;
use Image;

class TeacherController extends Controller
{

    public function index()
    {

        $teachersCollection = Teacher::latest();

        if (request('search')) {
            $teachersCollection = $teachersCollection
                ->where('teacher_id', 'like', '%' . request('search') . '%')
                ->orWhere('phone', 'like', '%' . request('search') . '%')
                ->orWhere('name', 'like', '%' . request('search') . '%');
        }

        $teachers = $teachersCollection->paginate(10);

        return view('backend.teachers.index', [
            'teachers' => $teachers
        ]);
    }

    public function create()
    {
        // $this->authorize('create-teacher');

        return view('backend.teachers.create');
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            Teacher::create([
                'teacher_id' => $request->teacher_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $this->uploadimg(request()->file('image')),
            ]);

            return redirect()->route('teachers.index')->withMessage('Successfully Created!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Teacher $teacher)
    {
        return view('backend.teachers.show', [
            'teacher' => $teacher
        ]);
    }

    public function edit(Teacher $teacher)
    {
        return view('backend.teachers.edit', [
            'teacher' => $teacher
        ]);
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        try {
            $requestData = [
                'teacher_id' => $request->teacher_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                // 'image' => $this->uploadimg(request()->file('image')),
            ];

            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $name = time() . '.' . $img->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/teachers/');
                $img->move($destinationPath, $name);
                $teacher->img = $name;
            }

            $teacher->update($requestData);

            return redirect()->route('teachers.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Teacher $teacher)
    {
        try {
            $teacher->delete();
            return redirect()->route('teachers.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    // Softdelete
    public function trash()
    {
        $teachers = Teacher::onlyTrashed()->get();

        return view('backend.teachers.trashed', [
            'teachers' => $teachers
        ]);
    }

    public function restore($id)
    {
        $teacher = Teacher::onlyTrashed()->findOrFail($id);
        $teacher->restore();
        return redirect()->route('teachers.trashed')->withMessage('Successfully Restored!');
    }

    public function delete($id)
    {
        $teacher = Teacher::onlyTrashed()->findOrFail($id);
        unlink(public_path('storage/teachers/' . $teacher->img));
        $teacher->forceDelete();
        return redirect()->route('teachers.trashed')->withMessage('Successfully Deleted Permanently!');
    }

    public function uploadimg($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        Image::make($file)
            ->resize(364, 105)
            ->save(storage_path() . '/app/public/teachers/' . $fileName);

        return $fileName;
    }
}
