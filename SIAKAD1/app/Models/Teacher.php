<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'employee_id',
        'specialization',
        'phone_number',
        'address',
        'photo',
        'join_date',
        'status',
        'bio',
    ];

    protected $casts = [
        'join_date' => 'date',
    ];

    /**
     * Get the user associated with the teacher.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the schedules for the teacher.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the achievements recorded by this teacher.
     */
    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }
}
