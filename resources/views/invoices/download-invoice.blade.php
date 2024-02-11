<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        .row {
            width: 100%;
            padding: 0 -15px;
        }

        .col-12 {
            width: 100%;
            padding: 0 15px;
        }

        .col-md-6 {
            width: 50%;
            padding: 0 15px;
        }
    </style>
</head>

<body class="font-sans">
    <div class="p-5 card card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mt-2 mb-4 overlay profile-pic" style="line-height: 25px; max-width: 500px">
                    @isset($data['itemResource']['user']['company'])
                        {{ $data['itemResource']['user']['company'] }}
                        <br />
                    @endisset
                    @isset($data['itemResource']['user']['address'])
                        {{ $data['itemResource']['user']['address'] }}
                        <br />
                    @endisset
                    @isset($data['itemResource']['user']['zipcode'])
                        {{ $data['itemResource']['user']['zipcode'] }},
                    @endisset
                    @isset($data['itemResource']['user']['address'])
                        {{ $data['itemResource']['user']['city'] }}<br />
                    @endisset
                    @isset($data['itemResource']['user']['country'])
                        {{ $data['itemResource']['user']['country'] }}
                        <br />
                    @endisset
                    @isset($data['itemResource']['user']['company_registration_number'])
                        Company Number:
                        {{ $data['itemResource']['user']['company_registration_number'] }}<br />
                    @endisset
                    @isset($data['itemResource']['user']['vat_number'])
                        VAT Number:
                        {{ $data['itemResource']['user']['vat_number'] }}<br />
                    @endisset
                </div>
                <p class="mt-5 text-muted">Bill To:</p>
                <div class="clickable" style="border: 1px dashed #000">
                    <div class="my-2 ml-3" data-toggle="modal" data-target="#exampleModal">
                        @isset($data['itemResource']['client']['id'])
                            <a class="nav-link active">
                                @isset($data['itemResource']['client']['company'])
                                    {{ $data['itemResource']['client']['company'] }}<br />
                                @endisset
                                @isset($data['itemResource']['client']['address'])
                                    {{ $data['itemResource']['client']['address'] }}
                                    <br />
                                @endisset
                                @isset($data['itemResource']['client']['zipcode'])
                                    {{ $data['itemResource']['client']['zipcode'] }},
                                @endisset
                                @isset($data['itemResource']['client']['city'])
                                    {{ $data['itemResource']['client']['city'] }}<br />
                                @endisset
                                @isset($data['itemResource']['client']['country'])
                                    {{ $data['itemResource']['client']['country'] }}
                                    <br />
                                @endisset
                                @isset($data['itemResource']['client']['company_registration_number'])
                                    Company Number:{{ $data['itemResource']['client']['company_registration_number'] }}<br />
                                @endisset
                                @isset($data['itemResource']['client']['vat_number'])
                                    VAT Number:{{ $data['itemResource']['client']['vat_number'] }}
                                @endisset
                            </a>
                        @endisset
                        @empty($data['itemResource']['client']['id'])
                            <a class="nav-link active">
                                <i class="ml-2 fe fe-user"> </i>
                                Client Details Will Show Here
                            </a>
                        @endempty
                    </div>
                </div>
            </div>
            <!-- above this -->
            <div class="col-12 col-md-6 text-md-right">
                <div style="min-width: 200px; min-height: 200px">
                    <label for="upload-photo">
                        <img class="ml-8 image rounded-circle" src="{{ $data['itemResource']['invoice_logo_url'] }}"
                            alt="User Company Logo"
                            style="
                                  object-fit: cover;
                                  width: 200px;
                                  height: 200px;
                                " />
                    </label>
                </div>

                <div class="mr-4">
                    <h3 class="mb-3 invoice"
                        style="font-style: normal;
                    font-weight: normal;
                    font-size: 48px;
                    line-height: 56px;
                    align-items: center;
                    text-align: right;
                    color: #3c445f;">
                        Invoice</h3>
                    <div class="mb-3 d-flex justify-content-end" v-if="$itemResource.invoice_no">
                        <span class="mr-2 text-muted">Invoice no:</span>
                        <span>invoice_no</span>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <span class="mr-2 text-muted">Date:</span>
                        <input type="date" class="w-auto form-control form-control-sm" readonly
                            v-model="$itemResource.date" />
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <span class="mr-2 text-muted">Due Date:</span>
                        <input type="date" class="w-auto form-control form-control-sm" readonly
                            v-model="$itemResource.due_date" />
                    </div>
                    <br />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table my-4">
                        <thead class="tablehead">
                            <tr>
                                <th class="bg-transparent border-top-0">
                                    <span class="h6">Item & Description</span>
                                </th>
                                <th class="bg-transparent border-top-0">
                                    <span class="h6">Quantity</span>
                                </th>
                                <th class="bg-transparent border-top-0">
                                    <span class="h6">Rate</span>
                                </th>
                                <th class="bg-transparent border-top-0">
                                    <span class="h6">Amount</span>
                                </th>
                                <th class="text-right bg-transparent border-top-0">
                                    <span class="h6"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in $itemResource.items" :key="index">
                                <td class="td w-50">
                                    <input readonly class="form-control form-control-sm" type="text"
                                        v-model="item.item_detail" />
                                </td>
                                <td class="td">
                                    <input type="number" readonly class="form-control form-control-sm"
                                        v-model.number="item.qty" />
                                </td>
                                <td class="td">
                                    <currency-input :currency="$itemResource.selected_currency" :locale="userLocale"
                                        :allow-negative="false" readonly class="form-control form-control-sm"
                                        v-model.number="item.rate" />
                                </td>
                                <td class="text-right td">
                                    12
                                </td>
                                <td class="td">
                                    <!-- <button class="btn-rounded-circle badge-danger">
                                      <v-icon name="times"></v-icon>
                                    </button> -->
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">
                                    <strong>Subtotal</strong>
                                </td>
                                <td colspan="3" class="text-right">
                                    <span class="">
                                        123
                                    </span>
                                </td>
                            </tr>
                            <tr v-if="$itemResource.is_invoice_vat_applied">
                                <td colspan="2" class="text-right">
                                    <span></span>
                                    <label for="is_vat_applied"><strong>VAT (%)</strong></label>
                                </td>
                                <td colspan="3" class="text-right border-bottom">
                                    <span class="">
                                        <input type="number" readonly class="form-control form-control-sm"
                                            v-model.number="$itemResource.vat_value" />
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" class="text-right">
                                    <strong data-toggle="modal" data-target="#exampleModalCurrency"
                                        style="cursor: pointer">TOTAL
                                        (123)</strong>
                                </td>
                                <td colspan="3" class="text-right border-bottom">
                                    <span class="">
                                        132
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <template v-if="$itemResource.invoice_notes">
                    <hr class="my-5" />
                    <h6 class="text-uppercase">Notes</h6>
                    <p class="mb-0 text-muted">
                        invoice_notes
                    </p>
                </template>
                <template v-if="$itemResource.client.bank_details">
                    <!-- <hr class="my-5" /> -->
                    <h6 class="mt-4 text-uppercase">Bank Details</h6>
                    <p class="mb-0 text-muted">
                        bank_details
                    </p>
                </template>
            </div>
        </div>
    </div>
</body>

</html>
