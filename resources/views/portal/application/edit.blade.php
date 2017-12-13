@extends('layouts.app')

@section('title') | Application Approval @endsection

@section('content')
    @include('shared.defautlNavbar')
    <approval token="{{ $token }}"></approval>
@endsection