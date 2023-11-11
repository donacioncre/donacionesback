@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Requerimientos para donar sangre</h1>
                </div>
                <div class="col-sm-3">
                    {!! Form::open( ['route' => ['donationRequirements.addPoint', $donation->id], 'method' => 'PUT']) !!}
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="num" placeholder="añadir requerimientos" aria-label="añadir requerimientos" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Agregar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($donation, ['route' => ['donationRequirements.update', $donation->id], 'method' => 'patch', 'enctype'=>'multipart/form-data']) !!}

            <div class="card-body">
                <div class="row">
                    @include('donation_requirements.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('donationRequirements.index') }}" class="btn btn-default">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
