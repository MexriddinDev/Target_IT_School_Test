<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\Controller;
use App\Models\Admin\Option;
use App\Models\Admin\Question;
use Illuminate\Http\Request;
use function Pest\Laravel\json;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Question::with('options')->get();
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
            'question_id' => 'required|integer|exists:questions,id',
            'is_correct'  => 'required|boolean',
            'option_text' => 'required|string',
            'match_key'   => 'nullable|string',
        ]);

        return Option::create($validated);
    }


    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        return Option::with('question')->findOrFail($option->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        $validated = $request->validate([
            'question_id' => 'required|integer|exists:questions,id',
            'is_correct'  => 'required|boolean',
            'option_text' => 'required|string',
            'match_key'   => 'nullable|string',
        ]);

        $option->update($validated);
        return response()->json($option, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option = Option::findOrFail($option->id);
        $option->delete();
        return response()->json(['message' => 'Option deleted successfully'], 200);
    }
}
