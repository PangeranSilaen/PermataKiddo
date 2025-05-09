<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'registration_number',
        'birth_date',
        'gender',
        'address',
        'parent_name',
        'parent_phone',
        'parent_email',
        'photo',
        'status',
        'rejection_reason',
        'registration_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'registration_date' => 'date',
    ];

    /**
     * Get the user associated with the registration.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
