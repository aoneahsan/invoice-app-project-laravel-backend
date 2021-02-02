<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserProfileResource extends JsonResource
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
            "username" => $this->username,
            "name" => $this->name,
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "address" => $this->address,
            "state" => $this->state,
            "country" => $this->country,
            "logo" => $this->logo,
            "notes" => $this->notes,
            "logo_url" => $this->logo ? Storage::url($this->logo) : null,
            "company" => $this->company,
            "created_at" => $this->created_at
        ];
    }
}
