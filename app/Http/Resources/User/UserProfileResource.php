<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

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
            "company" => $this->company,
            "created_at" => $this->created_at
        ];
    }
}
