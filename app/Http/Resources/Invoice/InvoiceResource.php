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
            "id" => $this->id,
            "unique_id" => $this->unique_id,
            "invoice_no" => $this->invoice_no,
            "user_id" => $this->user_id,
            "client_id" => $this->client_id,
            "user" => $this->user ? $this->user : null,
            "client" => $this->client ? $this->client : null,
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
