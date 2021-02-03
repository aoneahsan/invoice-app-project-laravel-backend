<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Inertia\Inertia;
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
        $result = Invoice::create([
            "invoice_unique_id" => uniqid(),
            "user_id" => $request->user()->id,
            "client_id" => $request->has("client_id") ? $request->client_id : null,
            'user' => $request->has("user") ? json_encode($request->user) : null,
            'client' => $request->has("client") ? json_encode($request->client) : null,
            'invoice_logo' => $request->has("invoice_logo") ? $request->invoice_logo : null,
            'date' => $request->has("date") ? $request->date : null,
            'due_date' => $request->has("due_date") ? $request->due_date : null,
            'vat_value' => $request->has("vat_value") ? $request->vat_value : null,
            'is_invoice_vat_applied' => $request->has("is_invoice_vat_applied") ? $request->is_invoice_vat_applied : null,
            'items' => $request->has("items") ? json_encode($request->items) : null,
            'invoice_notes' => $request->has("invoice_notes") ? $request->invoice_notes : null,
            'invoice_terms' => $request->has("invoice_terms") ? $request->invoice_terms : null,
            'selected_currency' => $request->has("selected_currency") ? $request->selected_currency : null,
            'invoice_type' => $request->has("invoice_type") ? $request->invoice_type : null,
            'sub_total' => $request->has("sub_total") ? $request->sub_total : null,
            'total' => $request->has("total") ? $request->total : null
        ]);
        if ($result) {
            $item = Invoice::where("id", $result->id)->first();
            return response()->json(['data' => new InvoiceResource($item)], 200);
        } else {
            return response()->json(['message' => "Error occured while adding invoice."], 500);
        }
    }

    public function show(Request $request, $invoice_unique_id)
    {
        $item = Invoice::where("invoice_unique_id", $invoice_unique_id)->first();
        Inertia::setRootView("layouts.frontend.index");
        $itemResource = new InvoiceResource($item);
        return Inertia::render("Frontend/Invoice/Create", [
            "invoice" => $itemResource
        ]);
    }

    public function update(Request $request, $invoice_unique_id)
    {
        $oldItem = Invoice::where("invoice_unique_id", $invoice_unique_id)->first();
        $result = $oldItem->update([
            "user_id" => $request->user()->id,
            "client_id" => $request->has("client_id") ? $request->client_id : null,
            'user' => $request->has("user") ? json_encode($request->user) : null,
            'client' => $request->has("client") ? json_encode($request->client) : null,
            'invoice_logo' => $request->has("invoice_logo") ? $request->invoice_logo : null,
            'date' => $request->has("date") ? $request->date : null,
            'due_date' => $request->has("due_date") ? $request->due_date : null,
            'vat_value' => $request->has("vat_value") ? $request->vat_value : null,
            'is_invoice_vat_applied' => $request->has("is_invoice_vat_applied") ? $request->is_invoice_vat_applied : null,
            'items' => $request->has("items") ? json_encode($request->items) : null,
            'invoice_notes' => $request->has("invoice_notes") ? $request->invoice_notes : null,
            'invoice_terms' => $request->has("invoice_terms") ? $request->invoice_terms : null,
            'selected_currency' => $request->has("selected_currency") ? $request->selected_currency : null,
            'invoice_type' => $request->has("invoice_type") ? $request->invoice_type : null,
            'sub_total' => $request->has("sub_total") ? $request->sub_total : null,
            'total' => $request->has("total") ? $request->total : null
        ]);
        if ($result) {
            $item = Invoice::where("invoice_unique_id", $invoice_unique_id)->first();
            return response()->json(['data' => new InvoiceResource($item)], 200);
        } else {
            return response()->json(['message' => "Error occured while updating invoice."], 500);
        }
    }

    public function destroy(Request $request, $invoice_unique_id)
    {
        $item = Invoice::where("invoice_unique_id", $invoice_unique_id)->delete();
        if ($item) {
            return response()->json(['data' => "invoice deleted"], 200);
        } else {
            return response()->json(['message' => "Error occured while deleting invoice."], 500);
        }
    }
}
