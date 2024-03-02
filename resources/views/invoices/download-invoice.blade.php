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
    background: red;
}

.div-child {
    display: table-cell;
}
.div-child1 {
    background: green;
}
.div-child2 {
    background: purple;
}

    </style>
</head>

<body class="font-sans">
    <div style="width:100%;padding-left:20px;padding-right:20px;padding-bottom:16px;background-color: rgb(255 255 255 / 1);">
        <div class="div-parent">
            {{-- Info and bill to --}}
            <div class="div-child div-child1">
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
            <div class="div-child div-child2">
                <div style="width:200px;height:200px;">
                    <img style="width:100%;height:100%;" alt='invoice image' src="{{ 'data:image/png;base64,' . base64_encode(Storage::read($invoiceLogoPath)) }}" />
                </div>
            </div>
        </div>
    </div>

</body>

</html>
