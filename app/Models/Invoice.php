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
            'searchable' => true,
        ],
        'invoice_no' => [
            'searchable' => true,
        ],
        'invoice_user' => [
            'searchable' => false,
        ],
        'invoice_client' => [
            'searchable' => false,
        ],
        'invoice_date' => [
            'searchable' => true,
        ],
        'invoice_due_date' => [
            'searchable' => true,
        ],
        'invoice_notes' => [
            'searchable' => true,
        ],
        'subtotal' => [
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
