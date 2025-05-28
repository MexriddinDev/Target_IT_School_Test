<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /** @use HasFactory<\Database\Factories\LevelFactory> */
    use HasFactory;


    protected $fillable = [
        'course_id',
        'level_name'
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function tests(){
        return $this->hasMany(Test::class, 'level_id');
    }
}
