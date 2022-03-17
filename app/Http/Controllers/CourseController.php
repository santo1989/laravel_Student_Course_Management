<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
   
    public function index()
    {
        $courses = Course::latest()->where ('is_active', 0);
        return view('backend.courses.index', compact('courses'));
    }

    
    public function create()
    {
        return view('backend.courses.create');
    }

   
    public function store(StoreCourseRequest $request)
    {
        Course::create($request->all());

        return redirect()->route('courses.index')
                        ->with('success','Course created successfully');
    }

   
    public function show(Course $Course)
    {
        return view('backend.courses.show', compact('Course'));
    }

   
    public function edit(Course $Course)
    {
        return view('backend.courses.edit', compact('Course'));
    }

   
    public function update(UpdateCourseRequest $request, Course $Course)
    {
        $Course->update($request->all());

        return redirect()->route('courses.index')
                        ->with('success','Course updated successfully');
    }

   
    public function destroy(Course $Course)
    {
        $Course=Course::find($Course->id);
        $Course->delete();
        return redirect()->route('courses.index')
                        ->with('success','Course deleted successfully');
    }

    public function restore($id)
    {
        $Course = Course::onlyTrashed()->findOrFail($id);
        $Course->restore();
        return redirect()->route('courses.index')
                        ->with('success','Course restored successfully');
    }

    public function forcedeleted()
    {
        $courses = Course::onlyTrashed()->get();
        return view('backend.courses.index', compact('courses'));
    }
}
