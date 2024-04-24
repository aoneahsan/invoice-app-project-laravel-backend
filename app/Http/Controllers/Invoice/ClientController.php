<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\ClientResource;
use App\Models\Invoice\Client;
use App\Models\Invoice\Invoice;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use function PHPUnit\Framework\isEmpty;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::viewAny_client->name));

            $allClients = Client::where('user_id', $user->id)->withCount('invoices')->get();

            return ZHelpers::sendBackRequestCompletedResponse([
                'items' => ClientResource::collection($allClients)
            ]);
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::create_client->name));

            $request->validate([
                "address" => ['required', 'string'],
                "company" => ['required', 'string'],
                "country" => ['required', 'string'],
                "city" => ['required', 'string'],
                "zipcode" => ['required', 'string'],

                "name" => ['nullable', 'string'],
                "email" => ['nullable', 'string'],
                "phone_number" => ['nullable', 'string'],
                "registration_number" => ['nullable', 'string'],
                "vat_number" => ['nullable', 'string'],
                "default_currency" => ['nullable', 'json'],
                "bank_details" => ['nullable', 'string'],
                "notes" => ['nullable', 'string'],
                "is_active" => ['nullable', 'string'],
                "extra_attributes" => ['nullable', 'json'],
            ]);

            $result = Client::create([
                "unique_id" => uniqid(),
                "user_id" => $user->id,
                'name' => $request->has('name') ? $request->name : null,
                'email' => $request->has('email') ? $request->email : null,
                'phone_number' => $request->has('phone_number') ? $request->phone_number : null,
                'address' => $request->has('address') ?  $request->address : null,
                'company' => $request->has('company') ?  $request->company : null,
                'registration_number' => $request->has('registration_number') ?  $request->registration_number : null,
                'city' => $request->has('city') ?  $request->city : null,
                'zipcode' => $request->has('zipcode') ?  $request->zipcode : null,
                'vat_number' => $request->has('vat_number') ?  $request->vat_number : null,
                'default_currency' => $request->has('default_currency') ? ZHelpers::zJsonDecode($request->default_currency) : null,
                'bank_details' => $request->has('bank_details') ?  $request->bank_details : null,
                'notes' => $request->has('notes') ?  $request->notes : null,
                'country' => $request->has('country') ?  $request->country : null,
                'is_active' => $request->has('is_active') ?  $request->is_active : true,
                'extra_attributes' => $request->has('extra_attributes') ?  ZHelpers::zJsonDecode($request->extra_attributes) : null,
            ]);

            if ($result) {
                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new ClientResource($result)
                ]);
            } else {
                return ZHelpers::sendBackRequestFailedResponse(['message' => "Error occurred while adding client."]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request, $client_id)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::view_invoice->name));

            $client = Client::where('user_id', $user->id)->where('unique_id', $client_id)->first();

            if ($client) {
                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new ClientResource($client)
                ]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Client is not found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $client_id)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::update_client->name));

            $client = Client::where('user_id', $user->id)->where('unique_id', $client_id)->first();

            if ($client) {
                $request->validate([
                    "address" => ['required', 'string'],
                    "company" => ['required', 'string'],
                    "country" => ['required', 'string'],
                    "city" => ['required', 'string'],
                    "zipcode" => ['required', 'string'],

                    "name" => ['nullable', 'string'],
                    "email" => ['nullable', 'string'],
                    "phone_number" => ['nullable', 'string'],
                    "registration_number" => ['nullable', 'string'],
                    "vat_number" => ['nullable', 'string'],
                    "default_currency" => ['nullable', 'json'],
                    "bank_details" => ['nullable', 'string'],
                    "notes" => ['nullable', 'string'],
                    "is_active" => ['nullable', 'string'],
                    "extra_attributes" => ['nullable', 'json'],
                ]);

                $client->update([
                    'name' => $request->has('name') ? $request->name : $client->name,
                    'email' => $request->has('email') ? $request->email : $client->email,
                    'phone_number' => $request->has('phone_number') ? $request->phone_number : $client->phone_number,
                    'address' => $request->has('address') ?  $request->address : $client->address,
                    'company' => $request->has('company') ?  $request->company : $client->company,
                    'registration_number' => $request->has('registration_number') ?  $request->registration_number : $client->registration_number,
                    'city' => $request->has('city') ?  $request->city : $client->city,
                    'zipcode' => $request->has('zipcode') ?  $request->zipcode : $client->zipcode,
                    'vat_number' => $request->has('vat_number') ?  $request->vat_number : $client->vat_number,
                    'default_currency' => $request->has('default_currency') ?  ZHelpers::zJsonDecode($request->default_currency) : $client->default_currency,
                    'bank_details' => $request->has('bank_details') ? $request->bank_details : $client->bank_details,
                    'notes' => $request->has('notes') ?  $request->notes : $client->notes,
                    'country' => $request->has('country') ?  $request->country : $client->country,
                    'is_active' => $request->has('is_active') ?  $request->is_active : $client->is_active,
                    'extra_attributes' => $request->has('extra_attributes') ? ZHelpers::zJsonDecode($request->extra_attributes) : $client->extra_attributes,
                ]);

                $client = Client::where('user_id', $user->id)->where('unique_id', $client_id)->first();

                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new ClientResource($client)
                ]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Client is not found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    function destroy(Request $request, $client_id)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::delete_client->name));

            $client = Client::where('user_id', $user->id)->where('unique_id', $client_id)->first();
            if ($client) {
                if ($client->invoicesAndExpenses->isNotEmpty()) {
                    foreach ($client->invoicesAndExpenses as $item) {
                        if ($item->id) {
                            $invoice = Invoice::where('id', $item->id)->first();

                            if ($invoice->id) {
                                $invoice->delete();
                            }
                        }
                    }
                }
                $client->delete();
                return ZHelpers::sendBackRequestCompletedResponse(['item' => ['success' => true]]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Client is not found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }
}
