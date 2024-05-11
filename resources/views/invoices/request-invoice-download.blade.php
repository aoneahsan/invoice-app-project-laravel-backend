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

    <h1 class="mt-20 text-3xl font-bold text-red-900 underline text-clifford">
        Hello world!
    </h1>
    <form action="{{ route('download-invoice') }}" method="post">
        @csrf
        @method('POST')
        <button type="submit" class="p-20 bg-red-900">Download Invoice</button>
        {{ null !== '' && null ?? '---' }}
    </form>
</body>

</html>
