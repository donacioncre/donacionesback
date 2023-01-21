<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Ciudad:') !!}
    <p>{{ $city->name }}</p>
</div>

<!-- Country Id Field -->
<div class="col-sm-12">
    {!! Form::label('country_id', 'Provincia:') !!}
    <p>{{ $city->country->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Fecha de Creación:') !!}
    <p>{{ $city->created_at }}</p>
</div>


