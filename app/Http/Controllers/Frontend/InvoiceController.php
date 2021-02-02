<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class InvoiceController extends Controller
{
    public function getinvoices(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Invoice::eloquentQuery($sortBy, $orderBy, $searchValue);

        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    public function store(Request $request)
    {
        $item = Invoice::create([
            "user_id" => $request->user()->id,
            "client_id" => $request->has("client_id") ? $request->client_id : null,
            'user' => $request->has("user") ? json_encode($request->user) : null,
            'client' => $request->has("client") ? json_encode($request->client) : null,
            'invoice_logo' => $request->has("invoice_logo") ? json_encode($request->invoice_logo) : null,
            'date' => $request->has("date") ? json_encode($request->date) : null,
            'due_date' => $request->has("due_date") ? json_encode($request->due_date) : null,
            'vat_value' => $request->has("vat_value") ? json_encode($request->vat_value) : null,
            'is_invoice_vat_applied' => $request->has("is_invoice_vat_applied") ? json_encode($request->is_invoice_vat_applied) : null,
            'items' => $request->has("items") ? json_encode($request->items) : null,
            'invoice_notes' => $request->has("invoice_notes") ? json_encode($request->invoice_notes) : null,
            'invoice_terms' => $request->has("invoice_terms") ? json_encode($request->invoice_terms) : null,
            'selected_currency' => $request->has("selected_currency") ? $request->selected_currency : null,
            'invoice_type' => $request->has("invoice_type") ? $request->invoice_type : null,
            'sub_total' => $request->has("sub_total") ? $request->sub_total : null,
            'total' => $request->has("total") ? $request->total : null
        ]);
        if ($item) {
            return response()->json(['data' => "invoice Added"], 200);
        } else {
            return response()->json(['message' => "Error occured while adding invoice."], 500);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => "required|string|max:255",
    //         "email" => "required|email|max:255",
    //         "phone_number" => "max:255|min:6",
    //         "address" => "required",
    //         "company" => "string",
    //         "country" => "string"
    //     ]);

    //     $item = Invoice::where("id", $id)->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone_number' => $request->phone_number,
    //         'address' => $request->address,
    //         'company' => $request->company,
    //         'country' => $request->country
    //     ]);
    //     if ($item) {
    //         return response()->json(['data' => "invoice updated"], 200);
    //     } else {
    //         return response()->json(['message' => "Error occured while updating invoice."], 500);
    //     }
    // }

    // public function destroy(Request $request, $id)
    // {
    //     $item = Invoice::where("id", $id)->delete();
    //     if ($item) {
    //         return response()->json(['data' => "invoice deleted"], 200);
    //     } else {
    //         return response()->json(['message' => "Error occured while deleting invoice."], 500);
    //     }
    // }
}
