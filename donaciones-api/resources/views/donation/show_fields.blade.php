


<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $donation->name }}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Dirección:') !!}
    <p>{{ $donation->address }}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('longitud', 'Longitud:') !!}
    <p>{{ $donation->longitude }}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('latitud', 'Latitud:') !!}
    <p>{{ $donation->latitude }}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Teléfono:') !!}
    <p>{{ $donation->phone }}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Número de Whatsapp:') !!}
    <p>{{ $donation->whatsapp_number }}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('correo', 'Correo:') !!}
    <p>{{ $donation->email }}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('ciudad', 'Ciudad:') !!}
    <p>{{ $donation->city->name }}</p>
</div>