<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeSalarySetup extends Model
{
    use HasFactory;
    protected $fillable = ['EmpID', 'PayHeadID', 'Amount', 'CompanyID', 'EntryUserID', 'EntryDate', 'IsActive'];
}
