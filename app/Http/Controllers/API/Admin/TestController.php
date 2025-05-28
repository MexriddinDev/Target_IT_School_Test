<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\Controller;
use App\Models\Admin\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Test::with( 'level')->get();
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
            'level_id'=>'required|exists:levels,id',
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'test_time'=>'required|integer|min:1',
        ]);

        return Test::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        return Test::with('level')->findOrFail($test->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $validated = $request->validate([
            'level_id' => 'required|exists:levels,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'test_time' => 'required|integer|min:1',
        ]);

        return $test->update($validated);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $test = Test::findOrFail($test->id);
        $test->delete();
        return response()->json(['message' => 'Test deleted successfully'], 200);
    }
}
