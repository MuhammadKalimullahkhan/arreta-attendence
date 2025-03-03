<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
