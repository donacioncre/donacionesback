@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar Beneficio</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($benefitDonating, ['route' => ['benefitDonatings.update', $benefitDonating->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    {{-- @include('benefit_donatings.fields') --}}

                    <!-- Title Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('title', 'Titulo:') !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Details Field -->
                        <div class="form-group col-sm-10 col-lg-10">
                            {!! Form::label('details', 'Detalles:') !!}
                            {!! Form::textarea('details', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        @foreach ($benefitDonating->donation_details as $item)
                             <!-- Points Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('points', 'Punto:') !!}
                                {!! Form::text('points[]', $item->points, ['class' => 'form-control']) !!}
                            </div>
                        @endforeach
                       

                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('benefitDonatings.index') }}" class="btn btn-default">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
