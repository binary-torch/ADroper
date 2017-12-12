@extends('portal.components.layout')

@section('create-application-active')
    active
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10 col-md-offset-1">
            <create-application></create-application>
        </div>
    </div>
@endsection