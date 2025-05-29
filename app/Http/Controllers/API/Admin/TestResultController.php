<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\Controller;
use App\Models\Admin\TestResult;
use App\Models\Admin\Student;
use App\Models\Admin\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestResultController extends Controller
{
    /**
     * Display a listing of all test results for all students.
     */
    public function index()
    {
        $testResults = TestResult::with('student', 'test')->get();

        return response()->json([
            'status' => 'success',
            'data' => $testResults
        ], 200);
    }

    /**
     * Store a newly created test result.
     */
    public function store(Request $request)
    {
        // Validatsiya qilish
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'test_id' => 'required|exists:tests,id',
            'duration_time' => 'required|integer',
            'submitted_at' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        // Kod darajasida tekshirish: testni bir marta ishlash
        $existingResult = TestResult::where('student_id', $request->student_id)
            ->where('test_id', $request->test_id)
            ->first();

        if ($existingResult) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bu o‘quvchi allaqachon ushbu testni topshirgan!'
            ], 409);
        }

        // Test natijasini saqlash
        $testResult = TestResult::create([
            'student_id' => $request->student_id,
            'test_id' => $request->test_id,
            'duration_time' => $request->duration_time,
            'submitted_at' => $request->submitted_at
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Test natijasi saqlandi',
            'data' => $testResult
        ], 201);
    }

    /**
     * Display the specified test result.
     */
    public function show($testResultId)
    {
        // Test natijasini topish
        $testResult = TestResult::with('student', 'test')->findOrFail($testResultId);

        $response = [
            'status' => 'success',
            'data' => [
                'test_result_id' => $testResult->id,
                'student_id' => $testResult->student_id,
                'student_name' => $testResult->student->full_name,
                'test_id' => $testResult->test_id,
                'test_title' => $testResult->test->title,
                'duration_time' => $testResult->duration_time,
                'submitted_at' => $testResult->submitted_at
            ]
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestResult $testResult)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestResult $testResult)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestResult $testResult)
    {
    }
}
