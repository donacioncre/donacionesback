<!-- Ask Field -->
<div class="col-sm-12">
    {!! Form::label('ask', 'Pregunta:') !!}
    <p>{{ $questions->ask }}</p>
</div>

<!-- Answer Field -->
<div class="col-sm-12">
    {!! Form::label('answer', 'Respuesta:') !!}
    <p>{{ $questions->answer }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Fecha de Creacción:') !!}
    <p>{{ $questions->created_at }}</p>
</div>


