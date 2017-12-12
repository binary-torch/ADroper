@extends('portal.components.layout')

@section('dashboard-active')
    active
@endsection

@isset($applications)
    @section('top-content')
        <div class="section" style="background-image: linear-gradient(-45deg, #AB64F5 0%, #62DBF6 100%);">
            <div class="container" style="display: flex; align-items: center; padding: 10px">
                <div class="col-md-6">
                    <h3 class="txt-white-color no-margin">Your applications</h3>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('portal.application.create') }}" class="btn btn-white">New Application</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    @endsection
@endisset

@section('main-content')
    <div class="container-fluid">
        @if(auth()->user()->applications_count)
            <applications></applications>
        @else
            <div class="text-center">
                <div class="spacer"></div>
                <img src="@image(portal/noApplication.svg)">
                <h3>No applications found!</h3>
                <a href="{{ route('portal.application.create') }}" class="btn btn-rose">Start new application</a>
            </div>
        @endif
    </div>
@endsection