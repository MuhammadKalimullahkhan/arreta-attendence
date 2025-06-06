<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'designation_id',
        'year_id',
        'month_id',
        'date',
        'leave_type_id',
        'is_present',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_present' => 'boolean',
        ];
    }
    function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
