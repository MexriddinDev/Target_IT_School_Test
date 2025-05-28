<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\Controller;
use App\Models\Admin\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Level::with('course')->get();
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
            'level_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        return Level::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level)
    {
        return Level::with('course')->findOrFail($level->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Level $level)
    {
        $validated = $request->validate([
            'level_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

         return $level->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        $level = Level::findOrFail($level->id);
        return $level->delete();
    }
}
