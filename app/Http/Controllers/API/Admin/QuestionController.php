<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\Controller;
use App\Models\Admin\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Question::all();
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
            'test_id'        => 'required|integer',
            'question_text'  => 'nullable|string',
            'question_type'  => 'required|string|in:multiple_choice,checkbox,true_false,matching,fill_in_blank,short_answer,audio_input',
            'audio_path'     => 'nullable|string',
        ]);


        return Question::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return Question::with('answers')->findOrFail($question->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'test_id'       => 'required|integer',
            'question_text' => 'nullable|string',
            'question_type' => 'required|string|in:multiple_choice,checkbox,true_false,matching,fill_in_blank,short_answer,audio_input',
            'audio_path'    => 'nullable|string',
        ]);

        $question->update($validated);

        return response()->json([
            'message' => 'Savol muvaffaqiyatli yangilandi',
            'data' => $question
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question = Question::findOrFail($question->id);
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully'], 200);

    }
}
