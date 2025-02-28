<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeSalarySetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id',
        'pay_head_id',
        'amount',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];
}
