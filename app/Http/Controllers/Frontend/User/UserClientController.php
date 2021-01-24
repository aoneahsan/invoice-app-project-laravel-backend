<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
// use App\Http\Resources\User\ClientResource;
use App\Models\User\Client;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserClientController extends Controller
{
    public function getClients(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Client::eloquentQuery($sortBy, $orderBy, $searchValue);

        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255",
            "email" => "required|email|max:255",
            "phone_number" => "max:255|min:6",
            "address" => "required",
            "company" => "string",
            "country" => "string"
        ]);

        $item = Client::create([
            "user_id" => $request->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'company' => $request->company,
            'country' => $request->country
        ]);
        if ($item) {
            return response()->json(['data' => $item], 200);
        } else {
            return response()->json(['message' => "Error occured while adding client."], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required|string|max:255",
            "email" => "required|email|max:255",
            "phone_number" => "max:255|min:6",
            "address" => "required",
            "company" => "string",
            "country" => "string"
        ]);

        $item = Client::where("id", $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'company' => $request->company,
            'country' => $request->country
        ]);
        if ($item) {
            return response()->json(['data' => "Client updated"], 200);
        } else {
            return response()->json(['message' => "Error occured while updating client."], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        $item = Client::where("id", $id)->delete();
        if ($item) {
            return response()->json(['data' => "Client deleted"], 200);
        } else {
            return response()->json(['message' => "Error occured while deleting client."], 500);
        }
    }
}
