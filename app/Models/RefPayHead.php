<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RefPayHead extends Model
{
    use HasFactory;
    protected $fillable = ['Description', 'TypeID', 'IsEditable', 'CompanyID', 'EntryUserID', 'EntryDate', 'IsActive'];
}
