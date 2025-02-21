<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RefPayHeadType extends Model
{
    use HasFactory;
    protected $fillable = ['Description', 'CompanyID', 'EntryUserID', 'EntryDate', 'IsActive'];
}