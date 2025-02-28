<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefPayHead extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'ref_pay_head_type_id',
        'is_editable',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function entryUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'entry_user_id');
    }

    public function payHeadType(): BelongsTo
    {
        return $this->belongsTo(RefPayHeadType::class, 'ref_pay_head_type_id');
    }
}
