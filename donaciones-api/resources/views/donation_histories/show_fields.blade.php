<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $donationHistory->code }}</p>
</div>

<!-- Hemoglobin Field -->
<div class="col-sm-12">
    {!! Form::label('hemoglobin', 'Hemoglobin:') !!}
    <p>{{ $donationHistory->hemoglobin }}</p>
</div>

<!-- Weight Field -->
<div class="col-sm-12">
    {!! Form::label('weight', 'Weight:') !!}
    <p>{{ $donationHistory->weight }}</p>
</div>

<!-- Blood Pressure Field -->
<div class="col-sm-12">
    {!! Form::label('blood_pressure', 'Blood Pressure:') !!}
    <p>{{ $donationHistory->blood_pressure }}</p>
</div>

<!-- Note Field -->
<div class="col-sm-12">
    {!! Form::label('note', 'Note:') !!}
    <p>{{ $donationHistory->note }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $donationHistory->status }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $donationHistory->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $donationHistory->updated_at }}</p>
</div>

