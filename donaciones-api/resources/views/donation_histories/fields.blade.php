

<form action="{{route('histories.create')}}" method="GET"  id="form-fechasVisitas"  enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-sm-3">
            {!! Form::label('donation_date', 'Fecha:') !!}
            <input type="date" class="form-control " value="{{$date}}" name="donation_date" id="donation_date">

        </div>
        <div class="form-group col-sm-2">
            {!! Form::label('', '') !!}
            <button  class="btn btn-primary form-control submit" style="margin-top: 4%" type="submit" value="SUBMIT"> Consultar</button>
        </div>
</form>


{!! Form::open(['route' => 'histories.store']) !!}
    <div class="row">

        <div class=" form-group  col-sm-6">
            {!! Form::label('schedule_id', 'Donante:') !!}
            <select name="schedule_id" id="schedule_id" class="form-control " required >

                @if (count($schedules))
                    <option value="">Seleccionar </option>
                @else
                    <option value="">Sin Datos </option>
                @endif

                @foreach ($schedules as $key=>$value)
                    <option   value="{{$value['id']}}">
                        {{  $value->user->firstname ." ".
                            $value->user->lastname ." ".
                            $value->user->identification
                        }}
                        {{
                            ($value->type_donation == "plaqueta" )? '  Tipo donación: Plaqueta' : ''
                        }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Field -->
        <div class="form-group col-sm-3">
        <div class="form-check">
            {!! Form::hidden('status', 0, ['class' => 'form-check-input']) !!}
            {!! Form::checkbox('status', '1', null, ['class' => 'form-check-input']) !!}
            {!! Form::label('status', 'Estado de la Donación', ['class' => 'form-check-label']) !!}
        </div>
        </div>

        <!-- Code Field -->
        <div class="form-group col-sm-6">
        {!! Form::label('code', 'Código:') !!}
        {!! Form::text('code', null, ['class' => 'form-control' ,'required']) !!}
        </div>

        <!-- Hemoglobin Field -->
        <div class="form-group col-sm-6">
        {!! Form::label('hemoglobin', 'Hemoglobina:') !!}
        {!! Form::text('hemoglobin', null, ['class' => 'form-control' ,'required']) !!}
        </div>

        <!-- Weight Field -->
        <div class="form-group col-sm-6">
        {!! Form::label('weight', 'Peso:') !!}
        {!! Form::text('weight', null, ['class' => 'form-control' ,'required']) !!}
        </div>

        <!-- Blood Pressure Field -->
        <div class="form-group col-sm-6">
        {!! Form::label('blood_pressure', 'Presión Arterial:') !!}
        {!! Form::text('blood_pressure', null, ['class' => 'form-control','required']) !!}
        </div>


        <!-- Note Field -->
        <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('note', 'Nota:') !!}
        {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
        </div>


        <div class="card-footer">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('histories.index') }}" class="btn btn-default">Cancelar</a>
        </div>
    </div>
{!! Form::close() !!}
