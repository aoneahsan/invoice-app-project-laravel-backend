<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Default\User;
use App\Models\Invoice\Client;
use App\Models\Invoice\Invoice;
use App\Zaions\Enums\InvoiceType;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Helpers\ZHelpers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::viewAny_invoice->name));

            $allInvoice = Invoice::where('user_id', $user->id)->where('invoice_type', $type)->get();

            return ZHelpers::sendBackRequestCompletedResponse([
                'items' => InvoiceResource::collection($allInvoice)
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
    public function store(Request $request, $type)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::create_invoice->name));

            $request->validate([
                "client_unique_id" => ['required', 'string'],
                "invoice_no" => ['nullable', 'string'],
                "user" => ['nullable', 'json'],
                "invoice_logo" => ['nullable', 'json'],
                "date" => ['nullable', 'string'],
                "due_date" => ['nullable', 'string'],
                "vat_value" => ['nullable', 'numeric'],
                "is_invoice_vat_applied" => ['nullable', 'boolean'],
                "items" => ['nullable', 'json'],
                "invoice_notes" => ['nullable', 'string'],
                "invoice_bank_details" => ['nullable', 'string'],
                "invoice_terms" => ['nullable', 'json'],
                "selected_currency" => ['nullable', 'json'],
                "sub_total" => ['nullable', 'numeric'],
                "total" => ['nullable', 'numeric'],
                "is_active" => ['nullable', 'boolean'],
                "extra_attributes" => ['nullable', 'json'],
            ]);

            $selectedClient = Client::where('user_id', $user->id)->where('unique_id', $request->client_unique_id)->first();

            if ($selectedClient) {
                if ($type === InvoiceType::inv->value || $type === InvoiceType::exp->value) {
                    $result = Invoice::create([
                        "unique_id" => uniqid(),
                        "user_id" => $request->user()->id,
                        "client_id" => $selectedClient->id,
                        "invoice_no" => $request->has("invoice_no") ? $request->invoice_no : null,
                        'user' => $request->has("user") ? ZHelpers::zJsonDecode($request->user) : null,
                        // 'client' => $request->has("client") ? ZHelpers::zJsonDecode($request->client) : null,
                        'invoice_logo' => $request->has("client") ? ZHelpers::zJsonDecode($request->invoice_logo) : null,
                        'date' => $request->has("date") ? $request->date : null,
                        'due_date' => $request->has("due_date") ? $request->due_date : null,
                        'vat_value' => $request->has("vat_value") ? $request->vat_value : null,
                        'is_invoice_vat_applied' => $request->has("is_invoice_vat_applied") ? $request->is_invoice_vat_applied : null,
                        'items' => $request->has("items") ? ZHelpers::zJsonDecode($request->items) : null,
                        'invoice_notes' => $request->has("invoice_notes") ? $request->invoice_notes : null,
                        'invoice_bank_details' => $request->has("invoice_bank_details") ? ZHelpers::zJsonDecode($request->invoice_bank_details) : $user->bank_details,
                        'invoice_terms' => $request->has("invoice_terms") ? ZHelpers::zJsonDecode($request->invoice_terms) : null,
                        'selected_currency' => $request->has("selected_currency") ? ZHelpers::zJsonDecode($request->selected_currency) : null,
                        'invoice_type' => $type ?? null,
                        'sub_total' => $request->has("sub_total") ? $request->sub_total : null,
                        'total' => $request->has("total") ? $request->total : null,
                        'is_active' => $request->has("is_active") ? $request->is_active : null,
                        'extra_attributes' => $request->has("extra_attributes") ? ZHelpers::zJsonDecode($request->extra_attributes) : null,
                    ]);

                    if ($result) {
                        return ZHelpers::sendBackRequestCompletedResponse([
                            'item' => new InvoiceResource($result)
                        ]);
                    } else {
                        return ZHelpers::sendBackRequestFailedResponse(['message' => "Error occurred while adding invoice."]);
                    }
                } else {
                    return ZHelpers::sendBackRequestFailedResponse([
                        'item' => ['Not a valid invoice type.']
                    ]);
                }
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Selected client no fount']
                ]);
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
    public function view(Request $request, $type, $invoice_id)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::view_invoice->name));

            $invoice = Invoice::where('user_id', $user->id)->where('unique_id', $invoice_id)->where('invoice_type', $type)->with('client')->first();

            if ($invoice) {
                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new InvoiceResource($invoice)
                ]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Invoice is not found.']
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
    public function update(Request $request, $type, $invoice_id)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::update_invoice->name));

            $invoice = Invoice::where('user_id', $user->id)->where('unique_id', $invoice_id)->where('invoice_type', $type)->first();

            if ($invoice) {
                $request->validate([
                    "client_unique_id" => ['nullable', 'string'],
                    "invoice_no" => ['nullable', 'string'],
                    "user" => ['nullable', 'json'],
                    "invoice_logo" => ['nullable', 'json'],
                    "date" => ['nullable', 'string'],
                    "due_date" => ['nullable', 'string'],
                    "vat_value" => ['nullable', 'numeric'],
                    "is_invoice_vat_applied" => ['nullable', 'boolean'],
                    "items" => ['nullable', 'json'],
                    "invoice_notes" => ['nullable', 'string'],
                    "invoice_bank_details" => ['nullable', 'string'],
                    "invoice_terms" => ['nullable', 'json'],
                    "selected_currency" => ['nullable', 'json'],
                    // "invoice_type" => ['nullable', 'string'],
                    "sub_total" => ['nullable', 'numeric'],
                    "total" => ['nullable', 'numeric'],
                    "is_active" => ['nullable', 'boolean'],
                    "extra_attributes" => ['nullable', 'json'],
                ]);

                $newClientId = null;
                if ($request->has('client_unique_id')) {
                    $client = Client::where('unique_id', $request->client_unique_id)->first();

                    if ($client) {
                        if ($client->id !== $invoice->client_id) {
                            $newClientId = $client->id;
                        }
                    } else {
                        return ZHelpers::sendBackNotFoundResponse([
                            'item' => ['Client is not found.']
                        ]);
                    }
                }

                $invoice->update([
                    "client_id" =>  $newClientId ?? $invoice->client_id,
                    "invoice_no" => $request->has("invoice_no") ? $request->invoice_no : $invoice->invoice_no,
                    'user' => $request->has("user") ? ZHelpers::zJsonDecode($request->user) : $invoice->user,
                    'invoice_logo' => $request->has("invoice_logo") ? ZHelpers::zJsonDecode($request->invoice_logo) : $invoice->invoice_logo,
                    'date' => $request->has("date") ? $request->date : $invoice->date,
                    'due_date' => $request->has("due_date") ? $request->due_date : $invoice->due_date,
                    'vat_value' => $request->has("vat_value") ? $request->vat_value : $invoice->vat_value,
                    'is_invoice_vat_applied' => $request->has("is_invoice_vat_applied") ? $request->is_invoice_vat_applied : $invoice->is_invoice_vat_applied,
                    'items' => $request->has("items") ? ZHelpers::zJsonDecode($request->items) : $invoice->items,
                    'invoice_notes' => $request->has("invoice_notes") ? $request->invoice_notes : $user->invoice_notes,
                    'invoice_bank_details' => $request->has("invoice_bank_details") ? ZHelpers::zJsonDecode($request->invoice_bank_details) : $user->bank_details,
                    'invoice_terms' => $request->has("invoice_terms") ? ZHelpers::zJsonDecode($request->invoice_terms) : $invoice->invoice_terms,
                    'selected_currency' => $request->has("selected_currency") ?  ZHelpers::zJsonDecode($request->selected_currency) : $invoice->selected_currency,
                    // 'invoice_type' => $request->has("invoice_type") ? $request->invoice_type : $invoice->invoice_type,
                    'sub_total' => $request->has("sub_total") ? $request->sub_total : $invoice->sub_total,
                    'total' => $request->has("total") ? $request->total : $invoice->total,
                    'is_active' => $request->has("is_active") ? $request->is_active : $invoice->is_active,
                    'extra_attributes' => $request->has("extra_attributes") ? ZHelpers::zJsonDecode($request->extra_attributes) : $invoice->extra_attributes,
                ]);

                $invoice = Invoice::where('user_id', $user->id)->where('unique_id', $invoice_id)->where('invoice_type', $type)->first();

                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new InvoiceResource($invoice)
                ]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Invoice is not found.']
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
    function destroy(Request $request, $type, $invoice_id)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::delete_invoice->name));

            $invoice = Invoice::where('user_id', $user->id)->where('unique_id', $invoice_id)->where('invoice_type', $type)->first();

            if ($invoice) {
                $invoice->delete();
                return ZHelpers::sendBackRequestCompletedResponse(['item' => ['success' => true]]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Invoice is not found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }


    public function downloadInvoicesPhpDownload(Request $request, $type, $invoice_id)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::download_invoice->name));

            $invoice = Invoice::where("user_id", $user->id)->where("unique_id", $invoice_id)->where("invoice_type", $type)->first();

            if (empty($invoice)) {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Invoice is not found.']
                ]);
            }
            $itemResource = new InvoiceResource($invoice);
            $user = User::where("id", $request->user()->id)->first();
            $pdfData = [
                "data" => [
                    "itemResource" => $itemResource,
                    "user" => $user,
                    "item" => $invoice
                ]
            ];

            $pdf = Pdf::loadView('invoices/download-invoice', $pdfData);
            return $pdf->download('invoice-' . $invoice->invoice_no . '.pdf');
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }
}
