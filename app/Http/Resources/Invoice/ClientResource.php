<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->unique_Id,
            "name" => $this->name ?? null,
            "email" => $this->email ?? null,
            "phone_number" => $this->phone_number ?? null,
            "address" => $this->address ?? null,
            "company" => $this->company ?? null,
            "company_registration_number" => $this->company_registration_number ?? null,
            "zipcode" => $this->zipcode ?? null,
            "vat_number" => $this->vat_number ?? null,
            "default_currency" => $this->default_currency ?? null,
            "bank_details" => $this->bank_details ?? null,
            "notes" => $this->notes ?? null,
            "country" => $this->country ?? null,
            "is_active" => $this->is_active ?? null,
            "extra_attributes" => $this->extra_attributes ?? null,
            "name" => $this->name ?? null,
        ];
    }
}
