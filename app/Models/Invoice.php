<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Invoice extends Model
{
    use HasFactory, SoftDeletes, LaravelVueDatatableTrait;

    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'invoice_unique_id' => [
            'searchable' => false,
        ],
        'invoice_no' => [
            'searchable' => true,
        ],
        'date' => [
            'searchable' => true,
        ],
        'due_date' => [
            'searchable' => true,
        ],
        'selected_currency' => [
            'searchable' => true,
        ],
        'vat_value' => [
            'searchable' => true,
        ],
        'is_invoice_vat_applied' => [
            'searchable' => true,
        ],
        'invoice_type' => [
            'searchable' => true,
        ],
        'sub_total' => [
            'searchable' => false,
        ],
        'total' => [
            'searchable' => true,
        ],
    ];

    protected $dataTableRelationships = [
        //
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
