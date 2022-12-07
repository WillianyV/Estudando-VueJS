@extends('layouts.app')

@section('content')
<login-component
csrf_token = "{{ @csrf_token() }}"
route_password_request = "{{ route('password.request') }}"
route_api_login = "{{ route('auth.login') }}"
>
</login-component>
@endsection
