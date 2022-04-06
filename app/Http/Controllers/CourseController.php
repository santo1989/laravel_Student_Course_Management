<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Database\QueryException;

class CourseController extends Controller
{

    public function index()
    {

        $coursesCollection = Course::latest();

        if (request('search')) {
            $coursesCollection = $coursesCollection
                ->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('course_code', 'like', '%' . request('search') . '%');
        }

        $courses = $coursesCollection->paginate(10);

        return view('backend.courses.index', [
            'courses' => $courses
        ]);
    }

    public function create()
    {
        // $this->authorize('create-course');

        return view('backend.courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        try {
            Course::create([
                'name' => $request->name,
                'course_code' => $request->course_code,
                'course_type' => $request->course_type,
                'course_duration' => $request->course_duration,
                'course_fee' => $request->course_fee,
            ]);

            return redirect()->route('courses.index')->withMessage('Successfully Created!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Course $course)
    {
        return view('backend.courses.show', [
            'course' => $course
        ]);
    }

    public function edit(Course $course)
    {
        return view('backend.courses.edit', [
            'course' => $course
        ]);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        try {
            $requestData = [
                'name' => $request->name,
                'course_code' => $request->course_code,
                'course_type' => $request->course_type,
                'course_duration' => $request->course_duration,
                'course_fee' => $request->course_fee,
            ];

            $course->update($requestData);

            return redirect()->route('courses.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->route('courses.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    // Softdelete
    public function trash()
    {
        $courses = Course::onlyTrashed()->get();

        return view('backend.courses.trashed', [
            'courses' => $courses
        ]);
    }

    public function restore($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();
        return redirect()->route('courses.trashed')->withMessage('Successfully Restored!');
    }

    public function delete($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->forceDelete();
        return redirect()->route('courses.trashed')->withMessage('Successfully Deleted Permanently!');
    }
}
