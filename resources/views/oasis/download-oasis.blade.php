<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 10px;
        }

        body {
            font-family: "Gill Sans", sans-serif;
            color: '#1c1919';
            padding: 3rem;
            font-size: 1.5rem;
        }

        div,
        h1,
        h2,
        h3,
        h4,
        p,
        span {
            font-family: inherit;
            color: inherit;
        }

        h1 {
            font-size: 5rem
        }

        h2 {
            font-size: 2.7rem
        }

        h3 {
            font-size: 1.8rem
        }

        /* Start Utilitys */
        .z-clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .z-justify-between::after {
            content: "";
            display: table;
            clear: both;
        }

        .z-float-left {
            float: left;
        }

        .z-float-right {
            float: right;
        }

        .z-text-xs {
            font-size: 1rem;
        }

        .z-text-sm {
            font-size: 1.2rem;
        }

        .z-text-white {
            color: #fff
        }

        .z-font-bold {
            font-weight: 700;
        }

        .z-font-normal {
            font-weight: 400;
        }

        .z-font-thin {
            font-weight: 100;
        }

        .z-text-center {
            text-align: center;
        }

        .z-border {
            border: 1px solid #1c1919;
        }

        .z-border-b {
            border-bottom: 1px solid #1c1919;
        }

        .border-right-none {
            border-right: 0px;
        }

        .z-bg-blue {
            background: #0975bb;
        }

        .z-mt-1rem {
            margin-top: 1rem;
        }

        .z-mt-p5rem {
            margin-top: .5rem;
        }

        .z-ms-auto {
            margin-left: auto;
        }

        .z-me-p5rem {
            margin-right: .5rem;
        }

        .z-ms-1rem {
            margin-left: 1rem;
        }

        .z-me-1rem {
            margin-right: 1rem;
        }

        .z-mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .z-mx-p5rem {
            margin-left: .5rem;
            margin-right: .5rem;
        }

        .z-ps-p5rem {
            padding-left: .5rem;
        }

        .z-ps-1rem {
            padding-left: 1rem;
        }

        .z-mt-3rem {
            margin-top: 3rem;
        }

        .z-mt-2rem {
            margin-top: 2rem;
        }

        .z-mt-4rem {
            margin-top: 4rem;
        }

        .z-p-1rem {
            padding: 1rem;
        }

        .z-p-p5rem {
            padding: .5rem;
        }

        .z-pt-1rem {
            padding-top: 1rem;
        }

        .z-pt-1p5rem {
            padding-top: 1.5rem;
        }

        .z-pt-1p3rem {
            padding-top: 1.3rem;
        }

        .z-p-1p5rem {
            padding: 1.5rem;
        }

        .z-pb-p5rem {
            padding-bottom: .5rem;
        }

        .z-pt-3rem {
            padding-top: 3rem;
        }

        .z-w-full {
            width: 100%;
        }

        .z-w-60per {
            width: 60%;
        }

        .z-w-1p8rem {
            width: 1.8rem;
        }

        .z-w-1p6rem {
            width: 1.6rem;
        }

        .z-w-1rem {
            width: 1.2rem;
        }

        .z-w-max {
            width: max-content;
        }

        .z-fixed-width {
            width: 136px;
        }

        .z-h-1p6rem {
            height: 1.6rem;
        }

        .z-h-1p2rem {
            height: 1.2rem;
        }

        .z-h-2p2rem {
            height: 2.2rem;
        }

        .z-relative {
            position: relative;
        }

        .z-absolute {
            position: absolute;
        }

        .z-checkbox-group {
            display: inline-block;
            margin-right: 1rem;
        }

        .z-table {
            display: table;
            width: auto;
        }

        .z-table-cell {
            display: table-cell;
            vertical-align: middle;
        }

        /* End Utilitys */
    </style>
</head>

<body>
    @include('oasis.parts.top-bar')

    {{-- PROPERTY SELECTION --}}
    @include('oasis.parts.property-selection')

    {{--  PERSONAL INFORMATION --}}
    @include('oasis.parts.personal-information')

    {{--  NOMINEE INFORMATION --}}
    @include('oasis.parts.nominee-information')

    @include('oasis.parts.bottom-bar')
</body>

</html>
