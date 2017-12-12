@extends('layouts.app')

@section('title')
    | Login
@endsection

@section('content')
    @include('shared.navbar', ['theme' => "navbar-default bg-light-gradient"])
    <login server="{{ config('app.server') }}"></login>
@endsection

@section('custom_js')
    <script>
        $().ready(function() {
            helpers.checkFullPageBackgroundImage();

            setTimeout(function() {
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
@endsection