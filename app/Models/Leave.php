<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'is_without_pay',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];
}

