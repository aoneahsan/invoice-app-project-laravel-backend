<?php

namespace App\Models\Default;

use App\Models\Default\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'extra_attributes' => 'array',
        'user_languages' => 'array',
        'user_skills' => 'array',
        'user_education' => 'array',
    ];

    // Relations
    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }
}
