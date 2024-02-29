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
</head>

<body>
    <img class="ml-8 image rounded-circle"
        src="{{ Storage::url('uploaded-files/MD4hlPZ3gYQke5y8HplE053sHQ4K4IUj8BsqB4Qu.jpg') }}" alt="User Company Logo"
        style="
                                  object-fit: cover;
                                  width: 200px;
                                  height: 200px;
                                " />
    <br />
    <img class="ml-8 image rounded-circle"
        src="{{ 'data:image/png;base64,' . base64_encode(Storage::read('uploaded-files/MD4hlPZ3gYQke5y8HplE053sHQ4K4IUj8BsqB4Qu.jpg')) }}"
        alt="User Company Logo v2" style="
      object-fit: cover;
      width: 200px;
      height: 200px;
    " />
    <form action="{{ route('download-invoice') }}" method="post">
        @csrf
        @method('POST')
        <button type="submit" class="bg-red-900 p-20">Download Invoice</button>
    </form>
</body>

</html>
