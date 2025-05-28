<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;


    protected $fillable = [
        'test_id',
        'question_text',
        'question_type',
        'audio_path',
    ];


    public function test(){
        return $this->belongsTo(Test::class, 'test_id');
    }


    public function options(){
        return $this->hasMany(Option::class, 'question_id');
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class, 'question_id');
    }
}
