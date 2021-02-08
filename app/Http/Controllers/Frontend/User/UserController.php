<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show(Request $request)
    {
        Inertia::setRootView("layouts.frontend.index");
        return Inertia::render("Frontend/User/Profile");
    }

    public function update(Request $request)
    {
        $request->validate([
            "email" => ["required", "max:255", "email", "string"]
        ]);

        $user = User::where("id", $request->user()->id)->first();
        $result = $user->update([
            'name' => $request->has('name') ? $request->name : $user->name,
            "phone_number" => $request->has("phone_number") ? $request->phone_number : $user->phone_number,
            "address" => $request->has("address") ? $request->address : $user->address,
            "state" => $request->has("state") ? $request->state : $user->state,
            "country" => $request->has("country") ? $request->country : $user->country,
            "company" => $request->has("company") ? $request->company : $user->company,
            "company_registration_number" => $request->has("company_registration_number") ? $request->company_registration_number : $user->company_registration_number,
            "city" => $request->has("city") ? $request->city : $user->city,
            "zipcode" => $request->has("zipcode") ? $request->zipcode : $user->zipcode,
            "vat_number" => $request->has("vat_number") ? $request->vat_number : $user->vat_number,
            "default_currency" => $request->has("default_currency") ? $request->default_currency : $user->default_currency,
            "logo" => $request->has("logo") ? $request->logo : $user->logo,
            "notes" => $request->has("notes") ? $request->notes : $user->notes
        ]);

        $updatedUser = User::where("id", $request->user()->id)->first();

        return response()->json(['data' => new UserProfileResource($updatedUser)], 200);
    }
}
