<!-- Days Field -->
<div class="form-group col-sm-6">
    {!! Form::label('days', 'Days:') !!}
    {!! Form::number('days', null, ['class' => 'form-control']) !!}
</div>

<!-- Donation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('donation_id', 'Donation Id:') !!}
    {!! Form::select('donation_id', ], null, ['class' => 'form-control custom-select']) !!}
</div>
