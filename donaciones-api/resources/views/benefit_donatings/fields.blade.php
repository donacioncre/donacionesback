<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Titulo:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Details Field -->
<div class="form-group col-sm-10 col-lg-10">
    {!! Form::label('details', 'Detalles:') !!}
    {!! Form::textarea('details', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('num', 'Número de Beneficios:') !!}
    {!! Form::number('num', null, ['class' => 'form-control']) !!}
</div>
