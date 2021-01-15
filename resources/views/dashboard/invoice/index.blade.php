@extends('dashboard.layout')

@section('content')
   <example-component  client_data =" {{$users}} " auth_user =" {{$auth_user}} " >

   </example-component>
@endsection
