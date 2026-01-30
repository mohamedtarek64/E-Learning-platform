<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'max_uses',
        'times_used',
        'valid_from',
        'valid_until',
        'applicable_courses',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'max_uses' => 'integer',
        'times_used' => 'integer',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'applicable_courses' => 'json',
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }
}
