<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Download Request</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-Bs5dy6Jv.css') }}">

</head>

<body>

    <h1 class="text-3xl font-bold underline text-clifford text-red-900 mt-20">
        Hello world!
    </h1>
    <form action="{{ route('download-invoice') }}" method="post">
        @csrf
        @method('POST')
        <button type="submit" class="bg-red-900 p-20">Download Invoice</button>
    </form>
</body>

</html>
