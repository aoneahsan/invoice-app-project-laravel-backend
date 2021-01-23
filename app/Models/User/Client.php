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
            'searchable' => false,
        ],
        'name' => [
            'searchable' => true,
        ],
        'email' => [
            'searchable' => true,
        ],
        'phone_number' => [
            'searchable' => true,
        ],
        'company' => [
            'searchable' => true,
        ],
        'country' => [
            'searchable' => true,
        ],
        'address' => [
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
