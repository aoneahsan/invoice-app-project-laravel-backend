<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    public function invoice_list()
    {
        $user = Auth::id();

        $invoices = Invoice::where('user_id', $user)->get();

        return view('dashboard.invoice.invoice_list', compact('invoices'));
    }
    public function invoice()
    {
        $auth_user =User::find(Auth::user()->id);
        $user = Auth::id();
        $users = Client::where('user_id', $user)->get();
        return view('dashboard.invoice.index',compact('users','auth_user'));
    }

    public function edit()
    {
        //
    }


    public function createClient(Request $request){
      $requestData= $request->all();
    //   dd($requestData);
      $client= new Client();
      $client->user_id=Auth::user()->id;
      $client->full_name=$requestData['full_name'];
      $client->email = $requestData['email'];
      $client->address = $requestData['address'];
      $client->company = $requestData['company'];
      $client->country = $requestData['country'];
      $client->phone = $requestData['phone'];

      $client->save();
      return response()->json($client);
    }


    public function createInvoice(Request $request){
    //    dd($request);
       $invoice= new Invoice();
       $invoice->user_id=Auth::user()->id;
       $invoice->client_id=$request->client_id;
       $invoice->invoice_no=$request->invoice_no;
       //add date field in db then you can save date here
       $invoice->due_date=$request->due_date;
       $invoice->sales_tax=$request->discount;
       $invoice->sub_total=$request->sub_total;
       $invoice->total=$request->total;
       $invoice->terms='fffffff';
       //saving item
        $items= $request->items;
        $to_insert = [];
        foreach ($items as $idx => $item) {
            array_push(
                $to_insert,
                [
                    'description' => $item['name'],
                    'quantity' => $item['qty'],
                    'rate' => $item['rate'],
                    'amount' => $item['rate'] * $item['qty'],
                ]
            );
        }
       //
       $invoice->save();
       $invoice->items()->createMany($to_insert);

       return response()->json($invoice);
       //now you get items array from request and save in db// if you want to see aatribute of item then inpect element in network tab
    }


    public function updateUser(Request $request){
        // dd($request->logo);
        $id =Auth::user()->id;
        $userData= User::find($id);
        $userData->name=$request->name;
        $userData->email = $request->email;
        $userData->address = $request->address;
        $userData->state = $request->state;
        $userData->country = $request->country;
        $userData->phone = $request->phone;

        if($request->hasFile('logo')) {
            $pic =$request->logo;
            $destinationPath = public_path()."/assets/images/invoices";
            $extension =  $pic->getClientOriginalExtension();
            $fileName = time();
            $fileName .= rand(11111,99999).'.'.$extension; // renaming image
            if(!$pic->move($destinationPath,$fileName))
            {
                throw new \Exception("Failed Upload");
            }

            $picture = asset("/assets/images/invoices")."/".$fileName;
            $userData->logo = $picture;

            // dd($userData->logo);
        }
        // dd($userData->logo);
        $userData->save();
        return response()->json($userData);
    //    $user= User::find();
    }
}
