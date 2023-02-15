@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Punto de Donación</h1>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-primary float-right"
                       href="{{ route('donation.edit', [$donation->id]) }}">
                        Editar
                    </a>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-default float-right"
                       href="{{ route('donation.index') }}">
                        Regresar
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('donation.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
