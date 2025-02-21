<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'CompanyID', 'EntryUserID', 'EntryDate', 'IsActive'];

    protected function casts(): array
    {
        return [
            'EntryDate' => 'datetime',
        ];
    }

}
