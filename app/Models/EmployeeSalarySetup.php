<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeSalarySetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'pay_head_id',
        'pay_head_type_id',
        'amount',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];
}
