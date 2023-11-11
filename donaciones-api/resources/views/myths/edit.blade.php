@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Mito</h1>
                </div>
                <div class="col-sm-3">
                    {!! Form::model($myths, ['route' => ['myths.addPoint', $myths->id], 'method' => 'PUT', 'files' => true]) !!}
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="num" placeholder="añadir mitos" aria-label="añadir mitos" aria-describedby="button-addon2">
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

            {!! Form::model($myths, ['route' => ['myths.update', $myths->id], 'method' => 'patch', 'files' => true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('myths.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('myths.index') }}" class="btn btn-default">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
