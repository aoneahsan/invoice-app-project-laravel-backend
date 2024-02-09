<?php

namespace App\Http\Resources\Default;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
            "user_intro" =>  $this->user_intro ?? null,
            "user_description" => $this->user_description ?? null,
            "user_average_response_time" => $this->user_average_response_time ?? null,
            "user_languages" => $this->user_languages ?? null,
            "user_skills" => $this->user_skills ?? null,
            "user_education" => $this->user_education ?? null,
            "cnic" => $this->cnic ?? null,
            "address" => $this->address ?? null,
            "city" => $this->city ?? null,
            "country" => $this->country ?? null,
            "cnic_front" => $this->cnic_front ?? null,
            "cnic_back" => $this->cnic_back ?? null,
            "facebook_link" => $this->facebook_link ?? null,
            "linkedin_link" => $this->linkedin_link ?? null,
            "linkedin_link" => $this->linkedin_link ?? null,
            "github_link" => $this->github_link ?? null,
            "is_active" => $this->is_active ?? null,
            "extra_attributes" => $this->extra_attributes ?? null,
            "created_at" => $this->created_at
        ];
    }
}
