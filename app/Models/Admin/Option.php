<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /** @use HasFactory<\Database\Factories\OptionFactory> */
    use HasFactory;

    Protected $fillable = [
        'question_id',
        'is_correct',
        'option_text',
        'match_key',
    ];


        public function question(){
            return $this->belongsTo(Question::class, 'question_id');
        }

        public function selectedOption(){
            return $this->hasMany(StudentAnswer::class, 'option_id');
        }

        public function matchedOption(){
            return $this->hasMany(StudentAnswer::class, 'matched_option_id');
        }
}
