<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RefPayHeadType extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];

    public function payHeadType()
    {
        return $this->belongsTo(RefPayHeadType::class, 'ref_pay_head_type_id');
    }
}
