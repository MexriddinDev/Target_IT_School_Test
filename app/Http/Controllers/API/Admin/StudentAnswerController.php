<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\Controller;
use App\Models\Admin\StudentAnswer;
use App\Models\Admin\Question;
use App\Models\Admin\Option;
use App\Models\Admin\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentAnswerController extends Controller
{
    public function index()
    {
        $studentAnswers = StudentAnswer::with(['testResult', 'question', 'option'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $studentAnswers
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'test_result_id' => 'required|exists:test_results,id',
            'question_id' => 'required|exists:questions,id',
            'selected_option_id' => 'nullable|exists:options,id',
            'written_answer' => 'nullable|string',
            'matched_option_id' => 'nullable|exists:options,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $studentAnswer = StudentAnswer::create($request->only([
            'test_result_id', 'question_id', 'selected_option_id', 'written_answer', 'matched_option_id'
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Javob saqlandi',
            'data' => $studentAnswer
        ], 201);
    }

    public function show($testResultId)
    {
        $testResult = TestResult::with('student', 'test')->findOrFail($testResultId);
        $answers = StudentAnswer::where('test_result_id', $testResultId)
            ->with(['question', 'option'])
            ->get();

        $answerDetails = $answers->map(function ($answer) {
            return [
                'question_id' => $answer->question_id,
                'question_text' => $answer->question->question_text,
                'selected_option_id' => $answer->selected_option_id,
                'selected_option_text' => $answer->option ? $answer->option->option_text : ($answer->written_answer ?? 'Javob yo‘q'),
                'is_correct' => $answer->option ? $answer->option->is_correct : false
            ];
        });

        $response = [
            'status' => 'success',
            'data' => [
                'test_result_id' => $testResult->id,
                'student_id' => $testResult->student_id,
                'student_name' => $testResult->student->full_name,
                'test_id' => $testResult->test_id,
                'test_title' => $testResult->test->title,
                'answers' => $answerDetails
            ]
        ];

        return response()->json($response, 200);
    }

    public function edit(StudentAnswer $studentAnswer) {}
    public function update(Request $request, StudentAnswer $studentAnswer) {}
    public function destroy(StudentAnswer $studentAnswer) {}
}
