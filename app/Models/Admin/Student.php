<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'password',
    ];

    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'student_id');
    }


}
