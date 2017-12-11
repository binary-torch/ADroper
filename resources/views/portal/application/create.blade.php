@extends('portal.components.layout')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10 col-md-offset-1">
            <create-application></create-application>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        helpers.initMaterialWizard();
    </script>
@endsection