<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /** @use HasFactory<\Database\Factories\TestFactory> */
    use HasFactory;


    protected $fillable = [
        'level_id',
        'title',
        'description',
        'test_time',
    ];

    public function level(){
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function questions(){
        return $this->hasMany(Question::class, 'test_id');
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'test_id');
    }
}
