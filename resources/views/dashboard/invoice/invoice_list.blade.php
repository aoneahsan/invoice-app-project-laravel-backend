@extends('dashboard.layout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

        <!-- Header -->
        <div class="header">
          <div class="header-body">
            <div class="row align-items-center">
              <div class="col">

                <!-- Title -->
                <h1 class="header-title">
                  Invoices
                </h1>

              </div>
              <div class="col-auto">

                <!-- Button -->
                <a href="{{route('invoice.create')}}" class="btn btn-primary lift">
                  Create New Invoice
                </a>

              </div>
            </div> <!-- / .row -->
          </div>
        </div>

        <!-- Card -->
        <div class="card" data-list="{&quot;valueNames&quot;: [&quot;orders-order&quot;, &quot;orders-product&quot;, &quot;orders-date&quot;, &quot;orders-total&quot;, &quot;orders-status&quot;, &quot;orders-method&quot;]}">

          <div class="table-responsive">
            <table class="table table-sm table-nowrap card-table">
              <thead>
                <tr>
                  <th>
                    Sr No

                  </th>
                  <th>
                      INVOICE NO      
                  </th>
                  <th>
                      Invoice To
                  </th>
                  <th>
                      Due Date
                  </th>
                  <th>
                      Created At
                  </th>
                  <th>
                      Actions
                  </th>
                </tr>
              </thead>
              <tbody class="list">
                  @foreach ($invoices as $invoice)
                <tr>
                  <td>
                    {{$invoice->id}}

                  </td>
                  <td class="orders-order">
                    <a href="{{route('invoice.edit', $invoice->id)}}">
                    {{$invoice->invoice_no}}
                    </a>
                  </td>
                  <td class="orders-order">
                    {{$invoice->client->name}}
                  </td>
                  <td class="orders-product">
                    {{$invoice->due_date}}
                  </td>
                  <td class="orders-date">
                    {{$invoice->created_at->format('d-m-Y')}}
                  </td>
                  <td class="orders-total">
                    <button class="btn btn-success btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                  </td>

                </tr>
                @endforeach
            </tbody>
            </table>
          </div>
        </div>

      </div>
    </div> <!-- / .row -->
  </div>
</div>
@endsection