<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_names',
        'n_carnet',
        'grade_id',
        'father_name',
        'mother_name',
        'age',
        'final_grade',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
