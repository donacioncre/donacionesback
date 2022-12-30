


<div class="form-group col-sm-12">
    <div class="col-sm-6">
        {!! Form::label('schedule_id', 'Donante:') !!}
        <select name="schedule_id" class="form-control "  >
            <option value="">Seleccionar </option>
            @foreach ($schedules as $key=>$value)
                <option   value="{{$value['id']}}">{{$value->user->firstname ." ". $value->user->lastname ."  Fecha: ". $value->donation_date}}</option>
            @endforeach
        </select>
    </div>
</div>


<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Hemoglobin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hemoglobin', 'Hemoglobin:') !!}
    {!! Form::text('hemoglobin', null, ['class' => 'form-control']) !!}
</div>

<!-- Weight Field -->
<div class="form-group col-sm-6">
    {!! Form::label('weight', 'Weight:') !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
</div>

<!-- Blood Pressure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('blood_pressure', 'Blood Pressure:') !!}
    {!! Form::text('blood_pressure', null, ['class' => 'form-control']) !!}
</div>

<!-- Note Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('note', 'Note:') !!}
    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('status', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('status', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('status', 'Status', ['class' => 'form-check-label']) !!}
    </div>
</div>
