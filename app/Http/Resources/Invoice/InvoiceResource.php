<?php

namespace App\Http\Resources\Invoice;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            "invoice_no" => $this->invoice_no,
            // "user_id" => $this->user_id,
            "client" => $this->client ? [
                'id' => $this->client['unique_id'] ?? null,
                'address' => $this->client['address'] ?? null ,
                'company' => $this->client['company'] ?? null,
                'country' => $this->client['country'] ?? null,
                'city' => $this->client['city'] ?? null,
                'vat_number' => $this->client['vat_number'] ?? null,
                'company_registration_number' => $this->client['company_registration_number'] ?? null,
            ] : null,
            "user" => $this->user ? $this->user : null,
            "invoice_logo" => $this->invoice_logo,
            // "invoice_logo_url" => $this->invoice_logo ? Storage::url($this->invoice_logo) : null,
            "date" => $this->date ? Carbon::make($this->date)->toDateString() : $this->date,
            "due_date" => $this->due_date ? Carbon::make($this->due_date)->toDateString() : $this->due_date,
            "vat_value" => $this->vat_value,
            "is_invoice_vat_applied" => $this->is_invoice_vat_applied,
            "items" => $this->items ? $this->items : null,
            "invoice_notes" => $this->invoice_notes,
            "invoice_bank_details" => $this->invoice_bank_details,
            "selected_currency" => $this->selected_currency,
            "invoice_type" => $this->invoice_type,
            "sub_total" => $this->sub_total,
            "total" => $this->total,
            "created_at" => $this->created_at
        ];
    }
}
