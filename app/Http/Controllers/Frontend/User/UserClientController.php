<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\User\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserClientController extends Controller
{
    public function getClients(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Client::where("user_id", $request->user()->id)->eloquentQuery($sortBy, $orderBy, $searchValue);

        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "address" => "required",
            "company" => "required",
            "country" => "required",
            "city" => "required",
            "zipcode" => "required"
        ]);

        $item = Client::create([
            "user_id" => $request->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'company' => $request->company,
            'company_registration_number' => $request->company_registration_number,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'vat_number' => $request->vat_number,
            'default_currency' => $request->default_currency,
            'bank_details' => $request->bank_details,
            'notes' => $request->notes,
            'country' => $request->country
        ]);
        if ($item) {
            return response()->json(['data' => $item], 200);
        } else {
            return response()->json(['message' => "Error occured while adding client."], 500);
        }
    }

    public function show(Request $request, $id)
    {
        $item = Client::where("user_id", $request->user()->id)->where("id", $id)->first();
        Inertia::setRootView("layouts.frontend.index");
        return Inertia::render("Frontend/Clients/Edit", [
            "client" => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "address" => "required",
            "company" => "required",
            "country" => "required",
            "city" => "required",
            "zipcode" => "required"
        ]);

        $client = Client::where("user_id", $request->user()->id)->where("id", $id)->first();
        $item = $client->update([
            'name' => $request->has("name") ? $request->name : $client->name,
            'email' => $request->has("email") ? $request->email : $client->email,
            'phone_number' => $request->has("phone_number") ? $request->phone_number : $client->phone_number,
            'address' => $request->has("address") ? $request->address : $client->address,
            'company' => $request->has("company") ? $request->company : $client->company,
            'company_registration_number' => $request->has("company_registration_number") ? $request->company_registration_number : $client->company_registration_number,
            'city' => $request->has("city") ? $request->city : $client->city,
            'zipcode' => $request->has("zipcode") ? $request->zipcode : $client->zipcode,
            'vat_number' => $request->has("vat_number") ? $request->vat_number : $client->vat_number,
            'default_currency' => $request->has("default_currency") ? $request->default_currency : $client->default_currency,
            'bank_details' => $request->has("bank_details") ? $request->bank_details : $client->bank_details,
            'notes' => $request->has("notes") ? $request->notes : $client->notes,
            'country' => $request->has("country") ? $request->country : $client->country
        ]);
        if ($item) {
            $client = Client::where("id", $id)->first();
            return response()->json(['data' => $client], 200);
        } else {
            return response()->json(['message' => "Error occured while updating client."], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        $item = Client::where("user_id", $request->user()->id)->where("id", $id)->delete();
        if ($item) {
            return response()->json(['data' => "Client deleted"], 200);
        } else {
            return response()->json(['message' => "Error occured while deleting client."], 500);
        }
    }
}
