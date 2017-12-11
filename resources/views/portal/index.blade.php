@extends('portal.components.layout')

@section('dashboard-active')
    active
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @component('components.card-status', [
                "color" => "green",
                "icon" => "school",
                "title" => "Workshops",
                "body" => 1,
                "tooltip" => "Workshops you have registered"
                ])@endcomponent
            </div>

            <div class="col-md-6">
                @component('components.card-status', [
                "color" => "red",
                "icon" => "attach_money",
                "title" => "Cash",
                "body" => "RM 0",
                "tooltip" => "Cash you gain through badges during the workshops contests (under development)"
                ])@endcomponent
            </div>
        </div>

        <div class="spacer"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">school</i>
                    </div>
                    <br>
                    <h4 class="card-title">Workshops</h4>
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Place</th>
                                    <th>Price</th>
                                    <th>Paid</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($workshops as $registration)
                                    <tr>
                                        <td>
                                            {{ $registration->workshop->title }}
                                        </td>
                                        <td>{{ $registration->batch->date }}</td>
                                        <td>{{ $registration->batch->place }}</td>
                                        <td>$ {{ $registration->total }}</td>
                                        <td><i class="material-icons">{{ $registration->paid ? "check_box" : "check_box_outline_blank"}}</i></td>
                                        <td class="td-actions text-right">
                                            @if($registration->paid && $registration->batch->materials_accessible)
                                                <a href="{{ route('portal.workshop.materials', $registration->workshop->slug) }}" type="button" class="btn btn-success">
                                                    Access Materials
                                                </a>
                                            @else
                                                @if(! $registration->paid)
                                                    <a href="#" type="button" class="btn" disabled="true" data-toggle="tooltip" data-placement="top" title="" data-container="body" data-original-title="Materials will be accessible after you confirm your registration.">
                                                        Access Materials
                                                    </a>
                                                @else
                                                    <a href="#" type="button" class="btn" disabled="true" data-toggle="tooltip" data-placement="top" title="" data-container="body" data-original-title="Materials will be accessible when the session begin.">
                                                        Access Materials
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <h3>You did not register with any workshop yet.</h3>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="spacer"></div>
    </div>
@endsection