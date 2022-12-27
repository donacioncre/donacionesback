<div class="form-group col-sm-12">
    <div class="col-sm-6">
        {!! Form::label('donation_id', 'Punto de Donación:') !!}
        <p>{{ $bloodDonationHours->name}}</p>
    </div>
</div>

@foreach ($bloodDonationHours->donationHour as $key=> $value)
    <!-- days -->
    <div class="form-group col-sm-4">
        {!! Form::label('days', 'Dia:') !!}

        <select name="weekdays[]" id="{{'day_'.$key}}" class="form-control "  >
            <option value="">{{nameDay( $value->days)}}</option>
        </select>
    </div>
    <div  class="form-group col-sm-2">
        {!! Form::label('start_time', 'Hora Inicio:') !!}
        <input type="time" class="form-control" name="start_time[]" value="{{$value->start_time}}">
    </div>
    <div  class="form-group col-sm-2">
        {!! Form::label('end_time', 'Hora Fin:') !!}
        <input type="time" class="form-control" name="start_time[]" value="{{$value->end_time}}">
    </div>

    <div  class="form-group col-sm-2">
        {!! Form::label('start_time', 'Hora Inicio:') !!}
        <input type="time" class="form-control" name="start_time[]" value="{{$value->start_time_1}}">
    </div>
    <div  class="form-group col-sm-2">
        {!! Form::label('end_time', 'Hora Fin:') !!}
        <input type="time" class="form-control" name="start_time[]" value="{{$value->end_time_1}}">
    </div>
    <!------------------------------------------------------------------->
@endforeach


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