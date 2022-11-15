<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Units extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_code',
        'unit_title'
    ];
    public function course():BelongsTo{
        return $this->belongsTo(Courses::class, "course_id");
    }
}
