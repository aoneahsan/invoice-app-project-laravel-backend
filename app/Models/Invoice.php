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
        'user' => [
            'searchable' => false,
        ],
        'client' => [
            'searchable' => false,
        ],
        'date' => [
            'searchable' => true,
        ],
        'due_date' => [
            'searchable' => true,
        ],
        'invoice_notes' => [
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
