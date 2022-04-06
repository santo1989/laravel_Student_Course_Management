<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Http\Requests\StoreMarkRequest;
use App\Http\Requests\UpdateMarkRequest;
use Illuminate\Database\QueryException;

class MarkController extends Controller
{


    public function index()
    {

        $marksCollection = Mark::latest();

        if (request('search')) {
            $marksCollection = $marksCollection
                ->where('student_id', 'like', '%' . request('search') . '%')
                ->orWhere('course_id', 'like', '%' . request('search') . '%')
                ->orWhere('mark', 'like', '%' . request('search') . '%');
        }

        $marks = $marksCollection->paginate(10);

        return view('backend.marks.index', [
            'marks' => $marks
        ]);
    }

    public function create()
    {
        // $this->authorize('create-mark');

        return view('backend.marks.create');
    }

    public function store(StoreMarkRequest $request)
    {
        try {
            Mark::create([
                'student_id' => $request->student_id,
                'course_id' => $request->course_id,
                'mark' => $request->mark,
            ]);

            return redirect()->route('marks.index')->withMessage('Successfully Created!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Mark $mark)
    {
        return view('backend.marks.show', [
            'mark' => $mark
        ]);
    }

    public function edit(Mark $mark)
    {
        return view('backend.marks.edit', [
            'mark' => $mark
        ]);
    }

    public function update(UpdateMarkRequest $request, Mark $mark)
    {
        try {
            $requestData = [
                'student_id' => $request->student_id,
                'course_id' => $request->course_id,
                'mark' => $request->mark,
            ];



            $mark->update($requestData);

            return redirect()->route('marks.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Mark $mark)
    {
        try {
            $mark->delete();
            return redirect()->route('marks.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    // Softdelete
    public function trash()
    {
        $marks = Mark::onlyTrashed()->get();

        return view('backend.marks.trashed', [
            'marks' => $marks
        ]);
    }

    public function restore($id)
    {
        $mark = Mark::onlyTrashed()->findOrFail($id);
        $mark->restore();
        return redirect()->route('marks.trashed')->withMessage('Successfully Restored!');
    }

    public function delete($id)
    {
        $mark = Mark::onlyTrashed()->findOrFail($id);
        $mark->forceDelete();
        return redirect()->route('marks.trashed')->withMessage('Successfully Deleted Permanently!');
    }
}
