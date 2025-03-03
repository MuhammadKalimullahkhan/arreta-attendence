<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'password',
        'cnic',
        'contact',
        'department_id',
        'role_id',
        'designation_id',
        'company_id',
        'entry_user_id',
        'entry_date',
        'is_active',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function designation():BelongsTo{
        return $this->belongsTo(Designation::class, 'designation_id');
    }
    public function role():BelongsTo{
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function department():BelongsTo{
        return $this->belongsTo(Department::class, 'department_id');
    }
}
