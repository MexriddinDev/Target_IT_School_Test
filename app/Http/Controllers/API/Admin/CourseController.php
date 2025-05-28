<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\Controller;
use App\Models\Admin\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        return Course::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return Course::findOrFail($course->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
        ]);
        $course=Course::findOrFail($course->id);
        return $course->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course = Course::findOrFail($course->id);
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully'], 200);
    }
}
