<div class="form-group col-sm-6">   
    {!! Form::label('donante', 'Donante:') !!}
    <p>{{$donationHistory->schedule->user->firstname}}
        {{$donationHistory->schedule->user->lastname}}  - Identificación:
    {{$donationHistory->schedule->user->identification}}</p>
</div>  
<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', 'Código:') !!}
    <p>{{ $donationHistory->code }}</p>
</div>

<!-- Hemoglobin Field -->
<div class="col-sm-12">
    {!! Form::label('hemoglobin', 'Hemoglobina:') !!}
    <p>{{ $donationHistory->hemoglobin }}</p>
</div>

<!-- Weight Field -->
<div class="col-sm-12">
    {!! Form::label('weight', 'Peso:') !!}
    <p>{{ $donationHistory->weight }}</p>
</div>

<!-- Blood Pressure Field -->
<div class="col-sm-12">
    {!! Form::label('blood_pressure', 'Presión Arterial:') !!}
    <p>{{ $donationHistory->blood_pressure }}</p>
</div>

<!-- Note Field -->
<div class="col-sm-12">
    {!! Form::label('note', 'Nota:') !!}
    <p>{{ $donationHistory->note }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Estado:') !!}
    <p>{{  $donationHistory->status == 1 ? 'Habilitado' : 'Deshabilitado' }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Fecha de creación:') !!}
    <p>{{ $donationHistory->created_at }}</p>
</div>

