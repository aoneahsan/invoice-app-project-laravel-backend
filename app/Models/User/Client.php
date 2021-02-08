<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Client extends Model
{
    use HasFactory, SoftDeletes, LaravelVueDatatableTrait;

    protected $dataTableColumns = [
        'id' => [
            'searchable' => false
        ],
        'name' => [
            'searchable' => true
        ],
        'email' => [
            'searchable' => true
        ],
        'phone_number' => [
            'searchable' => false
        ],
        'company' => [
            'searchable' => true
        ],
        'country' => [
            'searchable' => true
        ],
        'address' => [
            'searchable' => false
        ],
        'notes' => [
            'searchable' => false
        ],
        'company_registration_number' => [
            'searchable' => false
        ],
        'city' => [
            'searchable' => false
        ],
        'zipcode' => [
            'searchable' => false
        ],
        'vat_number' => [
            'searchable' => false
        ],
        'notes' => [
            'searchable' => false
        ],
        'bank_details' => [
            'searchable' => false
        ],
        'default_currency' => [
            'searchable' => false
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
