@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Asignar numero de citas por cada hora de atencion </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'storeAppointment']) !!}

            <div class="card-body">

                <div class="row">
                   <!-- Donation Id Field -->
                  
                   <input type="text" hidden name="donation_id" value="{{$id}}">
                    @foreach ($donation_hours as $key=> $itemHours)
                        <!-- days -->
                       
                        @foreach ($itemHours as $keyItem => $item)

                            <div  class="col-sm-2">
                                <span>{{nameDay( $keyItem)}}   -  Num. Donantes </span>
                                <input type="text" hidden name="day[]" value="{{$keyItem}}">
                                @foreach ($item  as $key => $value)
                                    <div class="input-group ">
                                        <input type="text" class="form-control" name="time_{{$keyItem}}[] "  value="{{$value}}">
                                        <input  type="text" class="form-control" name="num_attention_time_{{$keyItem}}[]" value="1">
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                       
                        <!------------------------------------------------------------------->
                    @endforeach

                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('bloodDonationHours.index') }}" class="btn btn-default">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection


@php

 function nameDay($nameDay)
    {
        $data=[
            'Lunes' =>'1',
            'Martes' =>'2',
            'Miercoles' =>'3',
            'Jueves'=>'4',
            'Viernes'=>'5',
            'Sabado'=>'6',
            'Domingo'=>'0'
        ];

        return array_search($nameDay,$data);
    }
@endphp

<script>

    var disabled = [];
    var disableOptions = function () {
    
        $('option').prop('disabled', false);
        $.each(disabled, function(key, val){
            $('option[value="' + val + '"]').prop('disabled', true);
        });
    };

    $(document).on('change', 'select', function () {
        disabled = [];
        $('select').each(function(){
            if($(this).val() != 'none'){
                $('option').prop('disabled', false);
                disabled.push( $(this).val() );
            }
        });
        disableOptions();
    });
    
</script>