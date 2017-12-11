@extends('layouts.app')

@section('title')
    | Login
@endsection

@section('content')
    @include('shared.navbar')
    @include('auth.login.components.header')
    @include('auth.login.components.form')
@endsection
