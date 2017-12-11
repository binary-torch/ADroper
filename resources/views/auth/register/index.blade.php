@extends('layouts.app')

@section('title')
    | Register
@endsection

@section('content')
    @include('shared.navbar')
    @include('auth.register.components.header')
    @include('auth.register.components.form')
@endsection
