<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Titulo:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('blood_type', 'Tipo de Sangre:') !!}
    {!! Form::text('blood_type', null, ['class' => 'form-control']) !!}
</div>
<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date', 'Fecha:') !!}
    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
</div>


<div class="clearfix"></div>


<!-- Author Field -->
<div class="form-group col-sm-6">
    {!! Form::label('donation_id', 'Centro de Donación:') !!}
    {!! Form::select('donation_id', $donations,null, ['class' => 'form-control']) !!}
  
</div>