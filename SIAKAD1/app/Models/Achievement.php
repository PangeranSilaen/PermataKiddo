<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'subject',
        'achievement_type',
        'score',
        'description',
        'achievement_date',
        'semester',
        'academic_year',
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'achievement_date' => 'date',
    ];

    /**
     * Get the student that owns the achievement.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the teacher that recorded the achievement.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
