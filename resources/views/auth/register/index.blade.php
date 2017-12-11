@extends('layouts.app')

@section('title')
    | Register
@endsection

@section('content')
    @include('shared.navbar', ['theme' => "navbar-default bg-light-gradient"])
    @include('auth.register.components.header')
@endsection

@section('custom_js')
    <script>
        $().ready(function() {
            helpers.checkFullPageBackgroundImage();
        });
    </script>
@endsection