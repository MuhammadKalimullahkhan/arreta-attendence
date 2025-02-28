<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'EntryDate' => 'datetime',
        ];
    }

}
