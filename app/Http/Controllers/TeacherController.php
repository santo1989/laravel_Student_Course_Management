<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{

    public function index()
    {
        $teachers = Teacher::latest();
        return view('backend.teachers.index', compact('teachers'));
    }


    public function create()
    {
        return view('backend.teachers.create');
    }


    public function store(StoreTeacherRequest $request)
    {
        Teacher::create($request->all());

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher created successfully');
    }


    public function show(Teacher $teacher)
    {
        return view('backend.teachers.show', compact('teacher'));
    }


    public function edit(Teacher $teacher)
    {
        return view('backend.teachers.edit', compact('teacher'));
    }


    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->all());

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully');
    }


    public function destroy(Teacher $teacher)
    {
        $teacher = Teacher::find($teacher->id);
        $teacher->delete();
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully');
    }
}
