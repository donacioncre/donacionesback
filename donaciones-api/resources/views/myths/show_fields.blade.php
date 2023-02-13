<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Titulo:') !!}
    <p>{{ $myth->title }}</p>
</div>

<!-- Details Field -->
<div class="col-sm-12">
    {!! Form::label('details', 'Detalles:') !!}
    <p>{{ $myth->details }}</p>
</div>

<!-- Ask Field -->
<div class="col-sm-12">
    {!! Form::label('ask', 'Pregunta:') !!}
    <p>{{ $myth->ask }}</p>
</div>

<!-- Answer Field -->
<div class="col-sm-12">
    {!! Form::label('answer', 'Respuesta:') !!}
    <p>{{ $myth->answer }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Imagen:') !!}
    <p>{{ $myth->image }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Fecha de Creación:') !!}
    <p>{{ $myth->created_at }}</p>
</div>



