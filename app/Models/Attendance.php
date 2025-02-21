<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['employeeId', 'designationId', 'yearId', 'monthId', 'date', 'status', 'isPresent', 'CompanyID', 'EntryUserID', 'EntryDate', 'IsActive'];
}
