<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\StudentAnswerFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'test_result_id',
        'question_id',
        'selected_option_id',
        'written_answer',
        'matched_option_id',
    ];


    public function testResult()
    {
        return $this->belongsTo(TestResult::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function selectedOption()
    {
        return $this->belongsTo(Option::class, 'selected_option_id');
    }

    public function matchedOption()
    {
        return $this->belongsTo(Option::class, 'matched_option_id');
    }
}
