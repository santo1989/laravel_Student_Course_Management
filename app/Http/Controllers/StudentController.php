<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Database\QueryException;

class StudentController extends Controller
{

    public function index()
    {

        $studentsCollection = Student::latest();

        if (request('search')) {
            $studentsCollection = $studentsCollection
                ->where('student_id', 'like', '%' . request('search') . '%')
                ->orWhere('class', 'like', '%' . request('search') . '%')
                ->orWhere('name', 'like', '%' . request('search') . '%');
        }

        $students = $studentsCollection->paginate(10);

        return view('backend.students.index', [
            'students' => $students
        ]);
    }

    public function create()
    {
        // $this->authorize('create-student');

        return view('backend.students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            Student::create([
                'student_id' => $request->student_id,
                'class' => $request->class,
                'name' => $request->name,
            ]);

            return redirect()->route('students.index')->withMessage('Successfully Created!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Student $student)
    {
        return view('backend.students.show', [
            'student' => $student
        ]);
    }

    public function edit(Student $student)
    {
        return view('backend.students.edit', [
            'student' => $student
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            $requestData = [
                'student_id' => $request->student_id,
                'class' => $request->class,
                'name' => $request->name,
            ];

            

            $student->update($requestData);

            return redirect()->route('students.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    // Softdelete
    public function trash()
    {
        $students = Student::onlyTrashed()->get();

        return view('backend.students.trashed', [
            'students' => $students
        ]);
    }

    public function restore($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->restore();
        return redirect()->route('students.trashed')->withMessage('Successfully Restored!');
    }

    public function delete($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->forceDelete();
        return redirect()->route('students.trashed')->withMessage('Successfully Deleted Permanently!');
    }
}
