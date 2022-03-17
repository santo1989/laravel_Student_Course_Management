<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::latest();
        return view('backend.students.index', compact('students'));
    }


    public function create()
    {
        return view('backend.students.create');
    }


    public function store(StoreStudentRequest $request)
    {
        Student::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully');
    }


    public function show(Student $student)
    {
        return view('backend.students.show', compact('student'));
    }


    public function edit(Student $student)
    {
        return view('backend.students.edit', compact('student'));
    }


    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

        return redirect()->route('backend.students.index')
            ->with('success', 'Student updated successfully');
    }


    public function destroy(Student $student)
    {
        $student = Student::find($student->id);
        $student->delete();
        return redirect()->route('backend.students.index')
            ->with('success', 'Student deleted successfully');
    }
}
