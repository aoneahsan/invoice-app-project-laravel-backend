<?php

namespace App\Models\Default;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Default\UserDetails;
use App\Models\Invoice\Client;
use App\Models\Invoice\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'onboarding_details' => 'array',
        'logo' => 'array',
        'extra_attributes' => 'array',
        'bank_details' => 'array',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relations
    public function invoices(): HasMany {
        return  $this->hasMany(Invoice::class, 'user_id', 'id');
    }

    public function clients(): HasMany {
        return  $this->hasMany(Client::class, 'user_id', 'id');
    }

    public function user_details(): HasMany {
        return  $this->hasMany(UserDetails::class, 'user_id', 'id');
    }
}
