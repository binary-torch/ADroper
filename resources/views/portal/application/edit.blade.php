@extends('layouts.app')

@section('title') | Application Approval @endsection

@section('content')
    @include('shared.defautlNavbar')
    <div class="section">
        <div class="container text-center">
            <h1>One last step!</h1>
            <h3>Please confirm your approval!</h3>



            <div>
                <a href="#" class="btn btn-success">Approve Application</a>
                <a href="#" class="btn btn-danger">Reject With Reason</a>
            </div>
        </div>
    </div>
@endsection