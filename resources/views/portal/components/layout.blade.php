@extends('layouts.app')

@section('content')
    <div class="wrapper">
        @include('portal.components.sidebar')
        <div class="main-panel">
            @include('portal.components.navbar')
            @yield('top-content')
            <div class="content">
                @yield('main-content')
            </div>
            @include('portal.components.footer')
        </div>
    </div>
@endsection