<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        .w-full {
            width: 100%;
        }
        .w-50per{
            width: 50%;
        }
        .flex {
            display: flex;
        }
        .items-start {
            align-items: flex-start;
        }
        .justify-between {
            justify-content: space-between;
        }
        .container{
            padding-left: 1.25rem/* 20px */;
            padding-right: 1.25rem/* 20px */;
            padding-bottom: 1rem/* 16px */;
            background-color: rgb(255 255 255 / 1);
        }
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

        .page-break {
            page-break-after: always;
        }

        .demo {
            font-size: 90px;
            background-color: green;
        }
    </style>
</head>

<body class="font-sans">
    <div style="width:100%;padding-left:20px;padding-right:20px;padding-bottom:16px;background-color: rgb(255 255 255 / 1);">
        <div style="display: flex;flex-direction:row; width: 100%;background: red;">
            {{-- Info and bill to --}}
            <div style="width: 50%;display: inline-block">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; width:100%;">
                    <div style="width:100%;">
                        <span style="display: block; font-weight: 500; font-size: 15.2px;">{{$invoiceData['user']['company']}}</span>
                        <span style="display: block; font-weight: 500; margin-top: 4px; font-size: 15.2px;">{{$invoiceData['user']['address']}}</span>
                        <span style="display: block; font-weight: 500; margin-top: 4px; font-size: 15.2px;">{{$invoiceData['user']['city']}},{{$invoiceData['user']['country']}}</span>
                        <span style="display: block; font-weight: 500; margin-top: 4px; font-size: 15.2px;">{{$invoiceData['user']['country']}}</span>
                        <span style="display: block; font-weight: 500; margin-top: 4px; font-size: 15.2px;">{{__('Company Number:')}} {{$invoiceData['user']['company_number']}}</span>
                        <span style="display: block; font-weight: 500; margin-top: 4px; font-size: 15.2px;">{{__('VAT Number:')}} {{$invoiceData['user']['vat_number']}}</span>
                    </div>
                </div>
                <div style="margin-top:48px;">
                    <span style="display: block;color: rgb(185 198 219 / 1);font-weight: 500;margin-top:4px;font-size:15.2px;">Bill To:</span>

                    <div style="width: 100%;border:1px dashed #a4a8b7;border-radius:8px;min-height:52.48px;dispaly:flex;align-items: center;">
                        <div style="width: 100%;display: block;margin-inline-start:32px;font-weight: 500;margin-top: 16px; margin-bottom: 16px; font-size: 15.2px;">
                            <span style="display: block;font-weight: 500;font-size:15.2px;">{{$invoiceData['client']['company']}}</span>
                            <span style="display: block;font-weight: 500;font-size:15.2px;">{{$invoiceData['client']['city']}}, {{$invoiceData['client']['country']}}</span>
                            <span style="display: block;font-weight: 500;font-size:15.2px;">{{$invoiceData['client']['country']}}</span>
                            <span style="display: block;font-weight: 500;font-size:15.2px;">{{__('Company Number: ')}} {{$invoiceData['client']['company_registration_number']}}</span>
                            <span style="display: block;font-weight: 500;font-size:15.2px;">{{__('VAT Number: ')}} {{$invoiceData['client']['vat_number']}}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Invoice image --}}
            <div style="width: 50%;display: inline-block;">
                <div style="width:200px;height:200px;">
                    <img style="width:100%;height:100%;" alt='invoice image' src="{{ 'data:image/png;base64,' . base64_encode(Storage::read($invoiceLogoPath)) }}" />
                </div>
            </div>
        </div>
    </div>


    {{--  --}}
    <div class="demo">lsdfjklsdf</div>
    <h1 class="text-3xl font-bold underline text-clifford text-red-900 mt-20">
        Hello world!
    </h1>
    <h1 class="text-red-800 text-[90px]">askjdhkjashda</h1>
    <h1 style="font-size: 90px; background-color: red; color: white">askjdhkjashda</h1>
    <h2>skjdhfksd</h2>
    <div class="p-5 card card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mt-2 mb-4 overlay profile-pic" style="line-height: 25px; max-width: 500px">
                    @isset($invoiceData['user']['company'])
                        {{ $invoiceData['user']['company'] }}
                        <br />
                    @endisset
                    @isset($invoiceData['user']['address'])
                        {{ $invoiceData['user']['address'] }}
                        <br />
                    @endisset
                    @isset($invoiceData['user']['zipcode'])
                        {{ $invoiceData['user']['zipcode'] }},
                    @endisset
                    @isset($invoiceData['user']['address'])
                        {{ $invoiceData['user']['city'] }}<br />
                    @endisset
                    @isset($invoiceData['user']['country'])
                        {{ $invoiceData['user']['country'] }}
                        <br />
                    @endisset
                    @isset($invoiceData['user']['company_registration_number'])
                        Company Number:
                        {{ $invoiceData['user']['company_registration_number'] }}<br />
                    @endisset
                    @isset($invoiceData['user']['vat_number'])
                        VAT Number:
                        {{ $invoiceData['user']['vat_number'] }}<br />
                    @endisset
                </div>
                <p class="mt-5 text-muted">Bill To:</p>
                <div class="clickable" style="border: 1px dashed #000">
                    <div class="my-2 ml-3" data-toggle="modal" data-target="#exampleModal">
                        @isset($invoiceData['client']['id'])
                            <a class="nav-link active">
                                @isset($invoiceData['client']['company'])
                                    {{ $invoiceData['client']['company'] }}<br />
                                @endisset
                                @isset($invoiceData['client']['address'])
                                    {{ $invoiceData['client']['address'] }}
                                    <br />
                                @endisset
                                @isset($invoiceData['client']['zipcode'])
                                    {{ $invoiceData['client']['zipcode'] }},
                                @endisset
                                @isset($invoiceData['client']['city'])
                                    {{ $invoiceData['client']['city'] }}<br />
                                @endisset
                                @isset($invoiceData['client']['country'])
                                    {{ $invoiceData['client']['country'] }}
                                    <br />
                                @endisset
                                @isset($invoiceData['client']['company_registration_number'])
                                    Company Number:{{ $invoiceData['client']['company_registration_number'] }}<br />
                                @endisset
                                @isset($invoiceData['client']['vat_number'])
                                    VAT Number:{{ $invoiceData['client']['vat_number'] }}
                                @endisset
                            </a>
                        @endisset
                        @empty($invoiceData['client']['id'])
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
                        <img class="ml-8 image rounded-circle"
                            src="{{ 'data:image/png;base64,' . base64_encode(Storage::read($invoiceLogoPath)) }}"
                            alt="User Company Logo v2" style="object-fit: cover; width: 200px; height: 200px; " />

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
