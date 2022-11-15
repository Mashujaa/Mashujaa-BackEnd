<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Courses extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_title'
    ];
    public function student() : BelongsTo{
        return $this->belongsTo(Student::class, "student_id");
    }
    public function units() : HasOne {
        return $this->hasOne(Units::class, "course_id", "course_id");
    }
}

