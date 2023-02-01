@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Horarios Donación Plaquetas</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('editAppointmentPlatelet',['id'=> $id]) }}">
                        Ver citas por hora
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($bloodDonationHours, ['route' => ['plateletDonationHours.update', $bloodDonationHours->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('platelet_donation_hours.edit_fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('plateletDonationHours.index') }}" class="btn btn-default">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
