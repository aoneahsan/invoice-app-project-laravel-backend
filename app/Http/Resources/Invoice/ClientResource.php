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
            "id" => $this->unique_id,
            "name" => $this->name ?? null,
            "email" => $this->email ?? null,
            "phone_number" => $this->phone_number ?? null,
            "invoices_count" => $this->invoices_count ?? 0,
            "address" => $this->address ?? null,
            "company" => $this->company ?? null,
            "city" => $this->city ?? null,
            "registration_number" => $this->registration_number ?? null,
            "zipcode" => $this->zipcode ?? null,
            "vat_number" => $this->vat_number ?? null,
            "default_currency" => $this->default_currency ?? null,
            "name" => $this->name ?? null,
            "bank_details" => $this->bank_details ?? null,
            "notes" => $this->notes ?? null,
            "country" => $this->country ?? null,
            "is_active" => $this->is_active ?? null,
            "extra_attributes" => $this->extra_attributes ?? null,
            "created_at" => $this->created_at
        ];
    }
}
