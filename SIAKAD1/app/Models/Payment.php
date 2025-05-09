<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'payment_type',
        'amount',
        'payment_method',
        'payment_date',
        'month',
        'academic_year',
        'receipt_number',
        'notes',
        'status',
        'payment_proof',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    /**
     * Get the student that owns the payment.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Generate a unique receipt number based on payment type
     * Format: SPP-[A-Z][0-9][0-9][0-9][0-9] for SPP payments
     * Format: LYN-[A-Z][0-9][0-9][0-9][0-9] for Other payments
     * 
     * @param string $paymentType
     * @return string
     */
    public static function generateReceiptNumber(string $paymentType): string
    {
        $prefix = $paymentType === 'spp' ? 'SPP-' : 'LYN-';
        
        // Get the latest receipt number with this prefix
        $latestPayment = self::where('receipt_number', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();
        
        if (!$latestPayment) {
            // If no payment with this prefix exists, start with A0001
            return $prefix . 'A0001';
        }
        
        $latestNumber = substr($latestPayment->receipt_number, 4); // Get the part after the prefix
        $letter = substr($latestNumber, 0, 1);
        $number = (int)substr($latestNumber, 1);
        
        if ($number < 9999) {
            // If number hasn't reached 9999, increment it
            $number++;
            return $prefix . $letter . str_pad($number, 4, '0', STR_PAD_LEFT);
        } else {
            // If number reached 9999, move to next letter
            $nextLetter = chr(ord($letter) + 1);
            
            // If we've gone through all letters A-Z, loop back to A
            if (ord($nextLetter) > ord('Z')) {
                $nextLetter = 'A';
            }
            
            return $prefix . $nextLetter . '0001';
        }
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();
        
        // Auto-generate receipt number before creating a new payment
        static::creating(function ($payment) {
            if (empty($payment->receipt_number)) {
                $payment->receipt_number = self::generateReceiptNumber($payment->payment_type);
            }
        });
    }
}
