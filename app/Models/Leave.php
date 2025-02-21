<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = ['employeeId', 'designationId', 'leaveTypeId', 'fromDate', 'numberOfDays', 'approval', 'approvalDate', 'isWithoutPay', 'CompanyID', 'EntryUserID', 'EntryDate', 'IsActive'];
}

