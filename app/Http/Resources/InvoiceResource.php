<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "invoice_unique_id" => $this->invoice_unique_id,
            "invoice_no" => $this->invoice_no,
            "user_id" => $this->user_id,
            "client_id" => $this->client_id,
            "user" => $this->user ? json_decode($this->user) : null,
            "client" => $this->client ? json_decode($this->client) : null,
            "invoice_logo" => $this->invoice_logo,
            "invoice_logo_url" => $this->invoice_logo ? Storage::url($this->invoice_logo) : null,
            "date" => $this->date,
            "due_date" => $this->due_date,
            "vat_value" => $this->vat_value,
            "is_invoice_vat_applied" => !!$this->is_invoice_vat_applied,
            "items" => $this->items ? json_decode($this->items) : null,
            "invoice_notes" => $this->invoice_notes,
            "selected_currency" => $this->selected_currency,
            "invoice_type" => $this->invoice_type,
            "sub_total" => $this->sub_total ? floatval($this->sub_total) : 0,
            "total" => $this->total ? floatval($this->total) : 0,
            "created_at" => $this->created_at
        ];
    }
}
