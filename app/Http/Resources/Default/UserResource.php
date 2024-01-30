<?php

namespace App\Http\Resources\Default;

use App\Zaions\Enums\OnboardingEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $onboarding = true;

        if ($this->onboarding_details &&
        $this->onboarding_details[OnboardingEnum::register->value] === true &&
        $this->onboarding_details[OnboardingEnum::profile->value] === true &&
        $this->onboarding_details[OnboardingEnum::currency->value] === true &&
        $this->onboarding_details[OnboardingEnum::bank_details->value] === true) {
            $onboarding = false;
        }

        return [
            "id" => $this->unique_Id ? $this->unique_Id : null,
            "username" => $this->username ? $this->username : null,
            "name" => $this->name ? $this->name : null,
            "email" => $this->email ? $this->email : null,
            "phone_number" => $this->phone_number ? $this->phone_number : null,
            "address" => $this->address ? $this->address : null,
            "state" => $this->state ? $this->state : null,
            "country" => $this->country ? $this->country : null,
            "logo" => $this->logo ? $this->logo : null,
            "notes" => $this->notes ? $this->notes : null,
            "bank_details" => $this->bank_details ? $this->bank_details : null,
            "logo" => $this->logo ? $this->logo : null,
            "company" => $this->company ? $this->company : null,
            "company_registration_number" => $this->company_registration_number ? $this->company_registration_number : null,
            "city" => $this->city ? $this->city : null,
            "zipcode" => $this->zipcode ? $this->zipcode : null,
            "vat_number" => $this->vat_number ? $this->vat_number : null,
            "default_currency" => $this->default_currency ? $this->default_currency : null,
            "onboarding_details" => $this->onboarding_details ? $this->onboarding_details : null,
            'onboarding' => $onboarding,
            "created_at" => $this->created_at ? $this->created_at : null
        ];
    }
}
