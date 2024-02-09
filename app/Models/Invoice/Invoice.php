<?php

namespace App\Models\Invoice;

use App\Models\Default\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        "user" => "array",
        "items" => "array",
        "invoice_bank_details" => "array",
        "invoice_terms" => "array",
        "extra_attributes" => "array",
        "date" => "datetime",
        "due_date" => "datetime",
        "invoice_logo" => "array",
        "selected_currency" => "array"
        // "is_invoice_vat_applied" => "boolean",
        // "sub_total" => "float",
        // "total" => "float"
    ];

    // Relations
    public function user(): BelongsTo {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function client(): BelongsTo {
        return  $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
