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
        'achievement_date',
        'semester',
        'academic_year',
        'achievements',
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'achievement_date' => 'date',
        'achievements' => 'array',
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

    /**
     * Get the count of achievements.
     */
    public function getAchievementsCountAttribute()
    {
        $ach = $this->achievements;
        if (is_array($ach)) {
            return count($ach);
        }
        if (is_string($ach) && !empty($ach)) {
            $arr = json_decode($ach, true);
            return is_array($arr) ? count($arr) : 0;
        }
        return 0;
    }
}
