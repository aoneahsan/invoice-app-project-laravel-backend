<?php

namespace App\Models\Invoice;

use App\Models\Default\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        "bank_details" => "array",
        "extra_attributes" => "array",
    ];

    // Relations
    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function invoices(): HasMany {
        return  $this->hasMany(Invoice::class, 'client_id', 'id');
    }
}
