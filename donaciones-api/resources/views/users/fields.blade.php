<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nombre Usuario') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('firstname', 'Nombres') !!}
    {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('lastname', 'Apellido') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('identification', 'Cédula') !!}
    {!! Form::text('identification', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('phone_number', 'Célular') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', 'Correo') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-4">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Confirmation Password Field -->
<div class="form-group col-sm-4">
      {!! Form::label('password', 'Password Confirmation') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>


<!-- Rol -->
<div class="form-group col-sm-4">
    {!! Form::label('rol', 'Roles') !!}
    {!! Form::select('roles[]',$roles,$userRole, ['class' => 'form-control']) !!}
</div>


