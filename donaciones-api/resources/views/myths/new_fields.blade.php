<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Titulo:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Details Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('details', 'Detalles:') !!}
    {!! Form::textarea('details', null, ['class' => 'form-control' , 'rows'=>'3']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('num', 'Número de Mitos:') !!}
    {!! Form::number('num', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>
