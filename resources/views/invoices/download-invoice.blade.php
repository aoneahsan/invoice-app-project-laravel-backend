<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        .z-w-full {
            width: 100%;
        }
        .z-w-50per{
            width: 50%;
        }
        .z-flex {
            display: flex;
        }
        .z-margin-left-auto{
            margin-left:auto;
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

        .mt-4px{
            margin-top: 4px;
        }
        .z-container{
            padding-left: 1.25rem/* 20px */;
            padding-right: 1.25rem/* 20px */;
            padding-bottom: 1rem/* 16px */;
            background-color: rgb(255 255 255 / 1);
        }

        .z-user-text{
            display: block; 
            font-weight: 500; 
            font-size: 15.2px;
        }

        .z-title{
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
        display: -webkit-box; /* wkhtmltopdf uses this one */
        display: flex;
        -webkit-box-pack: center; /* wkhtmltopdf uses this one */
        justify-content: center;
        }   
        .d-flex > div {
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }

        .d-flex > div:last-child {
            margin-right: 0;
        }

        .div-parent {
            display: table;
            width: 100%;
        }
        .div-child {
            display: table-cell;
        }
    </style>
</head>

<body class="font-sans">
    <div class="z-w-full z-container">
        <div class="div-parent">
            {{-- Info and bill to --}}
            <div class="div-child div-child1">
                <div class="z-w-full z-flex z-items-start z-justify-center">
                    <div class="z-w-full" style="width:100%;">
                        <span class="z-user-text">{{$invoiceData['user']['company']}}</span>
                        <span class="z-user-text mt-4px">{{$invoiceData['user']['address']}}</span>
                        <span class="z-user-text mt-4px">{{$invoiceData['user']['city']}},{{$invoiceData['user']['country']}}</span>
                        <span class="z-user-text mt-4px">{{$invoiceData['user']['country']}}</span>
                        <span class="z-user-text mt-4px">{{__('Company Number:')}} {{$invoiceData['user']['company_number']}}</span>
                        <span class="z-user-text mt-4px">{{__('VAT Number:')}} {{$invoiceData['user']['vat_number']}}</span>
                    </div>
                </div>
                <div style="margin-top:48px;">
                    <span class="z-user-text mt-4px" style="color: rgb(185 198 219 / 1);">Bill To:</span>

                    <div class="z-w-full z-flex" style="border:1px dashed #a4a8b7;border-radius:8px;min-height:52.48px;align-items: center;">
                        <div class="z-w-full" style="display: block;margin-inline-start:32px;font-weight: 500;margin-top: 16px; margin-bottom: 16px; font-size: 15.2px;">
                            <span class="z-user-text">{{$invoiceData['client']['company']}}</span>
                            <span class="z-user-text">{{$invoiceData['client']['city']}}, {{$invoiceData['client']['country']}}</span>
                            <span class="z-user-text">{{$invoiceData['client']['country']}}</span>
                            <span class="z-user-text">{{__('Company Number: ')}} {{$invoiceData['client']['company_registration_number']}}</span>
                            <span class="z-user-text">{{__('VAT Number: ')}} {{$invoiceData['client']['vat_number']}}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Invoice image --}}
            <div class="div-child div-child2">
                <div class="z-margin-left-auto" style="margin-left:auto;width:200px;height:200px;">
                    <img style="width:100%;height:100%;" alt='invoice image' src="{{ 'data:image/png;base64,' . base64_encode(Storage::read($invoiceLogoPath)) }}" />
                </div>
                <h3 class="z-margin-left-auto z-title">Invoice</h3>
                <div class="z-margin-left-auto z-flex z-w-full z-items-center z-justify-end">
                    <span style="margin-inline-end: 8px;color: rgb(185 198 219 / 1);font-weight: 500;margin-top: 4px;">Invoice no:</span>
                    <span style="width:160px;height:32px;padding-left:4px;padding-right: 4px;background-color: rgb(244 245 248 / 1); border: 1px soild rgb(244 245 248 / 1);color: rgb(34 36 40 / 1);font-size: 14px;line-height:20px;border-radius:6px;display: block;">{{$invoiceData->invoice_no}}</span>
                </div>
            </div>
            {{--  --}}
            <div class="z-margin-left-auto z-flex z-w-full z-items-center z-justify-end">
                <span style="margin-inline-end: 8px;color:#b9c6db;font-weight: 500;padding-top: 8px;">Date:</span>
                <span style="border:1px dashed #d2ddec;max-width: 384px;font-weight: 400;margin-top: 8px;border-radius: 4px;padding: 2px 8px; font-size: 13px; width: 131.2px">{{$invoiceData->date}}</span>
            </div>

            <div class="z-margin-left-auto z-flex z-w-full z-items-center z-justify-end">
                <span style="margin-inline-end: 8px;color:#b9c6db;font-weight: 500;padding-top: 8px;">Due Date:</span>
                <span style="border:1px dashed #d2ddec;max-width: 384px;font-weight: 400;margin-top: 8px;border-radius: 4px;padding: 2px 8px; font-size: 13px; width: 131.2px">{{$invoiceData->due_date}}</span>
            </div>
        </div>
    </div>

</body>

</html>
