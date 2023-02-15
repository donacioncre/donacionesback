@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Horario</h1>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-primary float-right"
                       href="{{ route('plateletDonationHours.edit', [$bloodDonationHours->id]) }}">
                        Editar
                    </a>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-default float-right"
                       href="{{ route('plateletDonationHours.index') }}">
                        regresar
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('platelet_donation_hours.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
