<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        /* @font-face {
            font-family: 'mont-regular';
            src: url({{ public_path('fonts/mont/mont-regular.ttf') }});
        } */

        .font-mont-regular,
        div,
        h1,
        p,
        span {
            font-family: 'mont-regular', sans-serif;
        }

        .text-color {
            color: #000
        }

        .z-w-full {
            width: 100%;
        }

        .z-w-50per {
            width: 50%;
        }

        .z-flex {
            display: flex;
        }

        .z-margin-left-auto {
            margin-left: auto;
        }

        .z-items-start {
            align-items: flex-start;
        }

        .z-items-center {
            align-items: center;
        }

        .z-justify-between {
            justify-content: space-between;
        }

        .z-justify-end {
            justify-content: flex-end;
        }

        .mt-4px {
            margin-top: 4px;
        }

        .z-ms-auto {
            margin-left: auto;
        }

        .z-w-50px {
            width: 50px;
        }

        .z-container {
            padding-left: 1.25rem
                /* 20px */
            ;
            padding-right: 1.25rem
                /* 20px */
            ;
            padding-bottom: 1rem
                /* 16px */
            ;
            background-color: rgb(255 255 255 / 1);
        }

        .z-user-text {
            display: block;
            font-weight: 500;
            font-size: 15.2px;
        }

        .z-title {
            font-size: 48px;
            font-weight: 400;
            color: rgb(60 68 95 / 1);
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

        .d-flex {
            display: -webkit-box;
            /* wkhtmltopdf uses this one */
            display: flex;
            -webkit-box-pack: center;
            /* wkhtmltopdf uses this one */
            justify-content: center;
        }

        .d-flex>div {
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }

        .d-flex>div:last-child {
            margin-right: 0;
        }

        .div-parent {
            display: table;
            width: 100%;
        }

        .div-child {
            display: table-cell;
        }

        th {
            padding: 16px;
            background: transparent;
            font-size: 10px;
            /* color: #3c445f; */
            color: #000;
            letter-spacing: -.02em;
            font-weight: 400;
            text-align: left;
        }
    </style>
</head>

<body class="font-roboto-regular">
    <div class="z-w-full z-container">
        <div class="div-parent">
            {{-- Info and bill to --}}
            <div class="div-child div-child1">
                <div class="z-w-full z-flex z-items-start z-justify-center">
                    <div class="z-w-full" style="width:100%;">
                        <span class="z-user-text">{{ $invoiceData['user']['company'] }}</span>
                        <span class="z-user-text mt-4px">{{ $invoiceData['user']['address'] }}</span>
                        <span class="z-user-text mt-4px">{{ $invoiceData['user']['city'] }}
                            {{ $invoiceData['user']['city'] !== null && $invoiceData['user']['city'] !== '' ? ',' : '' }}{{ $invoiceData['user']['country'] }}</span>
                        <span class="z-user-text mt-4px">{{ $invoiceData['user']['country'] }}</span>
                        <span class="z-user-text mt-4px">{{ __('Company Number:') }}
                            {{ $invoiceData['user']['company_number'] !== '' && $invoiceData['user']['company_number'] !== null ? $invoiceData['user']['company_number'] : '---' }}</span>
                        <span class="z-user-text mt-4px">{{ __('VAT Number:') }}
                            {{ $invoiceData['user']['vat_number'] !== '' && $invoiceData['user']['vat_number'] !== null ? $invoiceData['user']['vat_number'] : '---' }}</span>
                    </div>
                </div>
                <div style="margin-top:48px;">
                    <span class="z-user-text mt-4px text-color">Bill To:</span>

                    <div class="z-w-full"
                        style="border:1px dashed #a4a8b7;border-radius:8px;min-height:52.48px;align-items: center;">
                        <div class="z-w-full"
                            style="display: block;padding-left:32px;font-weight: 500;margin-top: 16px; margin-bottom: 16px; font-size: 15.2px;">
                            <span class="z-user-text">{{ $invoiceData['client']['company'] }}</span>
                            <span class="z-user-text">{{ $invoiceData['client']['city'] }},
                                {{ $invoiceData['client']['country'] }}</span>
                            <span class="z-user-text">{{ $invoiceData['client']['country'] }}</span>
                            <span class="z-user-text">{{ __('Company Number: ') }}
                                {{ $invoiceData['client']['company_registration_number'] }}</span>
                            <span class="z-user-text">{{ __('VAT Number: ') }}
                                {{ $invoiceData['client']['vat_number'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Invoice image, invoice number, date, & due date --}}
            <div class="div-child div-child2">
                @if (!empty($invoiceLogoPath))
                    <div class="z-margin-left-auto" style="width:200px;height:200px;">
                        <img style="width:100%;height:100%;" alt='invoice image'
                            src="{{ 'data:image/png;base64,' . base64_encode(Storage::read($invoiceLogoPath)) }}" />
                    </div>
                @endif

                <div class="z-margin-left-auto z-flex z-w-full z-items-center z-justify-end div-parent"
                    style="width:146px;">
                    <span class="z-title div-child text-color">
                        @if ($invoiceData->invoice_type === App\Zaions\Enums\InvoiceType::inv->value)
                            {{ __('Invoice') }}
                        @elseif ($invoiceData->invoice_type === App\Zaions\Enums\InvoiceType::exp->value)
                            {{ __('Expense') }}
                        @endif
                    </span>
                </div>

                @if (!empty($invoiceData->invoice_no))
                    <div class="z-margin-left-auto z-flex z-w-full z-items-center z-justify-end div-parent"
                        style="width:188px;">
                        <span class="div-child text-color"
                            style="margin-inline-end: 8px;font-weight: 500;margin-top: 4px;">
                            {{ __('Invoice no:') }}
                        </span>
                        <span class="div-child text-color"
                            style="width:max-content;height:32px;padding-left:7px;padding-right: 4px; border: 1px soild rgb(244 245 248 / 1);font-size: 14px;line-height:20px;border-radius:6px;display: block;">{{ $invoiceData->invoice_no }}</span>
                    </div>
                @endif

                @if (!empty($invoiceData->date))
                    <div class="z-margin-left-auto div-parent z-w-full z-items-center z-justify-end"
                        style="width:188px;margin-bottom: 9px;">
                        <div class="div-child" style="padding-left: 46px;">
                            <span class="text-color"
                                style="font-weight: 500;padding-top: 8px;">{{ __('Date:') }}</span>
                            <span class="text-color"
                                style="font-weight: 400;margin-top: 8px;border-radius: 4px;padding: 2px 0px; font-size: 13px; width: 131.2px;line-height:21px;">
                                {{ \Carbon\Carbon::parse($invoiceData->date)->format('d/m/Y') }}
                            </span>
                        </div>

                    </div>
                @endif

                @if (!empty($invoiceData->due_date))
                    <div class="z-margin-left-auto div-parent z-flex z-w-full z-items-center z-justify-end"
                        style="width:230px;">
                        <div class="div-child" style="padding-left: 58px;">
                            <span class="text-color" style="font-weight: 500;padding-top: 8px;line-height:21px;">
                                {{ __('Due Date:') }}</span>
                            <span class="text-color"
                                style="font-weight: 400;margin-top: 8px;border-radius: 4px;padding: 2px 0px; font-size: 13px; width: 131.2px;line-height:21px;">
                                {{ \Carbon\Carbon::parse($invoiceData->due_date)->format('d/m/Y') }}
                            </span>
                        </div>

                    </div>
                @endif
            </div>
        </div>

        {{--  --}}
        <div>
            <table class="div-parent"
                style="margin: 16px 0;border-spacing:0;border-bottom:1px solid #edf2f9;padding-bottom:20px;">
                <thead class="z-w-full" style="background: rgb(244, 244, 244);">
                    <tr class="z-w-full">
                        <th>{{ __('ITEM & DESCRIPTION') }}</th>

                        <th>{{ __('QUANTITY') }}</th>

                        <th>{{ __('RATE') }}</th>

                        <th colspan="2">
                            <div class="z-ms-auto z-w-50px">
                                {{ __('AMOUNT') }}</div>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @if (!empty($invoiceData->items))
                        @foreach ($invoiceData->items as $item)
                            <tr class="z-w-full">
                                <td style="padding: 16px 16px 16px 0px;width: 50%;border-top:1px solid #edf2f9;">
                                    <div class="z-w-full text-color" style="padding:2px 8px;font-size: 13px;">
                                        {{ $item['description'] }}</div>
                                </td>
                                <td style="padding: 16px;border-top:1px solid #edf2f9;">
                                    <div class="z-w-full text-color" style="padding:2px 8px;font-size: 13px;">
                                        {{ $item['quantity'] }}</div>
                                </td>

                                <td style="padding: 16px;border-top:1px solid #edf2f9;">
                                    <div class="z-w-full text-color" style="padding:2px 8px;font-size: 13px;">
                                        {{ $item['rate'] }}</div>
                                </td>

                                <td class="z-ms-auto" style="padding: 16px;border-top:1px solid #edf2f9;"
                                    colspan="2">
                                    <div class="text-color z-ms-auto z-w-50px" style="font-size: .825rem;">
                                        {{ $invoiceData['selected_currency']['symbol'] }}
                                        {{ $item['amount'] }}</div>
                                </td>

                                {{-- <td style="padding: 16px;border-top:1px solid #edf2f9;">
                                </td> --}}
                            </tr>
                        @endforeach
                    @endif


                    {{-- Subtotal --}}
                    <tr class="z-w-full">
                        <td style="padding:16px;background-color: transparent;border-top:1px solid #edf2f9;"
                            colspan="2">
                            <div class="text-color" style="font-size:16.16px;margin-left:auto;width:50px;">Subtotal
                            </div>
                        </td>

                        <td colspan="3"
                            style="padding:16px;background-color: transparent;margin-left:auto;border-top:1px solid #edf2f9;">
                            <div class="text-color" style='margin-right:4px;margin-left:auto;width:50px;'>
                                {{ $invoiceData['selected_currency']['symbol'] }} {{ $invoiceData->sub_total }}
                            </div>
                        </td>
                    </tr>

                    <tr class="z-w-full">
                        <td style="padding:16px;background-color: transparent;border-top:1px solid #edf2f9;"
                            colspan="2">
                            <div style="width:84px;margin-left:auto;">
                                <input type='checkbox'
                                    style="width:16px;height:16px;color: rgb(37 99 235 / 1);border-color: rgb(209 213 219 / 1);"
                                    checked="{{ $invoiceData->is_invoice_vat_applied }}" />
                                <label>{{ __('VAT (%)') }}</label>
                            </div>
                        </td>

                        <td colspan="3"
                            style="padding:16px;background-color: transparent;margin-left:auto;border-top:1px solid #edf2f9;">
                            <div class="text-color" style='margin-right:4px;margin-left:auto;padding:2px.env;width:50px;'>
                                {{ $invoiceData['selected_currency']['symbol'] }} {{ $invoiceData->vat_value }}
                            </div>
                        </td>
                    </tr>

                    <tr class="z-w-full">
                        <td style="padding:16px;background-color: transparent;border-top:1px solid #edf2f9;"
                            colspan="2">
                            <div class="text-color"
                                style="width:90px;margin-left:auto;font-weight: 700;font-size:16.16px;">
                                TOTAL ({{ $invoiceData['selected_currency']['symbol'] }})
                            </div>
                        </td>

                        <td colspan="3"
                            style="padding:16px;background-color: transparent;margin-left:auto;border-bottom:1px solid #edf2f9;border-top:1px solid #edf2f9;">
                            <div class="text-color" style='margin-right:4px;margin-left:auto;width:50px;'>
                                {{ $invoiceData['selected_currency']['symbol'] }} {{ $invoiceData->total }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- Notes --}}
            @if (!empty($invoiceData->invoice_notes))
                <div class="z-w-full" style="margin-top: 20px;">
                    <div class="text-color"
                        style="font-size: 14px;line-height: 20px;font-weight: 500;text-transform: uppercase;margin-top: 4px;font-size:16.32px;">
                        {{ __('Notes') }}</div>

                    <div class="z-w-full text-color"
                        style="font-size: 14px;line-height: 20px;color: rgb(17 24 39 / 1);font-weight: 400;white-space: pre-line;">
                        {{ $invoiceData->invoice_notes }}</div>
                </div>
            @endif

            {{-- Bank Details --}}
            @if (!empty($invoiceData->invoice_bank_details))
                <div class="z-w-full text-color" style="margin-top: 20px;">
                    <div
                        style="font-size: 14px;line-height: 20px;font-weight: 500;text-transform: uppercase;margin-top: 4px;font-size:16.32px;">
                        {{ __('Bank Details') }}</div>

                    <div class="z-w-full text-color"
                        style="font-size: 14px;line-height: 20px;color: rgb(17 24 39 / 1);font-weight: 400;white-space: pre-line;">
                        {{ $invoiceData->invoice_bank_details }}</div>
                </div>
            @endif
        </div>
    </div>

</body>

</html>
