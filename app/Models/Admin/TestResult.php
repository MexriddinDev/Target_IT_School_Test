<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    /** @use HasFactory<\Database\Factories\TestResultFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'test_id',
        'duration_time',
        'submitted_at',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }

    public function studentAnswers(){
        return $this->hasMany(StudentAnswer::class, 'test_result_id');
    }
}
