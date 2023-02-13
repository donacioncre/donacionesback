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

@foreach ([1,2,3,4,5,6,7,8,9] as $item)
    <!-- Points Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('points', 'Punto ' .$item .':') !!}
    {!! Form::text('points[]', null, ['class' => 'form-control']) !!}
    </div>
@endforeach
