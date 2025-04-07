<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'designation_id',
        'leave_type_id',
        'from_date',
        'number_of_days',
        'approval',
        'approval_date',
        'paid_leave',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];

    protected $casts = [
        'from_date' => 'date',
        'approval_date' => 'date',
        'entry_date' => 'datetime',
    ];

    function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}

