<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Titulo:') !!}
    <p>{{ $newCall->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Descripción:') !!}
    <p>{{ $newCall->description }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Imagen:') !!}
    <img src="{{ asset($newCall->image) }}" class="img-thumbnail" style="height: 50%">
  
</div>

<!-- Author Field -->
<div class="col-sm-12">
    {!! Form::label('author', 'Autor:') !!}
    <p>{{  $newCall->user->firstname  .' '. $newCall->user->lastname }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Fecha de creación :') !!}
    <p>{{ $newCall->created_at }}</p>
</div>



