<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nombre Usuario') !!}
    {!! Form::text('name', null, ['class' => 'form-control','autocomplete'=>"off" ,'required']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('firstname', 'Nombres') !!}
    {!! Form::text('firstname', null, ['class' => 'form-control' ,'required']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('lastname', 'Apellido') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control','required']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('identification', 'Cédula') !!}
    {!! Form::text('identification', null, ['class' => 'form-control','required']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('phone_number', 'Célular') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', 'Correo') !!}
    {!! Form::email('email', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-4">
    {!! Form::label('password', 'Contraseña') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Confirmation Password Field -->
<div class="form-group col-sm-4">
      {!! Form::label('password', 'Contraseña Confirmar') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>


<!-- Rol -->
<div class="form-group col-sm-4">
    {!! Form::label('rol', 'Roles') !!}
    {!! Form::select('roles[]',$roles,$userRole, ['class' => 'form-control']) !!}
</div>

<!-- Donation Center -->
<div class="form-group col-sm-4">
    {!! Form::label('donation_id', 'Centros de Donación ') !!}

    <select name="donation_id" id="donation_id" class="form-control "  >
        <option value="">Seleccionar </option>
        @foreach ($donation as $key=>$value)
            <option   @if($userDonation)
                        @if($userDonation->id == $key) selected  @endif 
                    @endif
            value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
</div>


<div class="form-group col-md-4 col-sm-4">
    <label for="status">Estado del Usuario </label>
    <div class="onoffswitch3">
        <input type="checkbox"  name="status" class="onoffswitch3-checkbox" id="status" 
            @isset($user->status)
                @if ($user->status == true)
                    checked
                @endif
            @endisset 
         >
        <label class="onoffswitch3-label" for="status">
            <span class="onoffswitch3-inner"></span>
            <span class="onoffswitch3-switch"></span>
        </label>
    </div>
</div>

<style>
    
    .onoffswitch3 {
        position: relative;
        width: 90px;
        -webkit-user-select:none;
        -moz-user-select:none;
        -ms-user-select: none;
    }
    .onoffswitch3-checkbox {
        display: none;
    }
    .onoffswitch3-label {
        display: block;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid #999999;
        border-radius: 5px;
    }
    .onoffswitch3-inner {
        display: block;
        width: 200%;
        margin-left: -100%;
        -moz-transition: margin 0.3s ease-in 0s;
        -webkit-transition: margin 0.3s ease-in 0s;
        -o-transition: margin 0.3s ease-in 0s;
        transition: margin 0.3s ease-in 0s;
    }
    .onoffswitch3-inner:before, .onoffswitch3-inner:after {
        display: block;
        float: left;
        width: 50%;
        height: 30px;
        padding: 0;
        line-height: 30px;
        font-size: 14px;
        color: white;
        font-family: Trebuchet, Arial, sans-serif;
        font-weight: bold;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    .onoffswitch3-inner:before {
        content: "Activo";
        padding-left: 10px;
        background-color: #2FCCFF;
        color: #FFFFFF;
    }
    .onoffswitch3-inner:after {
        content: "Inactivo";
        padding-right: 10px;
        background-color: #EEEEEE;
        color: #999999;
        text-align: right;
    }
    .onoffswitch3-switch {
        display: block;
        width: 18px;
        height: 31px;
        margin: 0px;
        background: #FFFFFF;
        border: 2px solid #999999;
        border-radius: 5px;
        position: absolute;
        right: 68px;
        -moz-transition: all 0.3s ease-in 0s;
        -webkit-transition: all 0.3s ease-in 0s;
        -o-transition: all 0.3s ease-in 0s;
        transition: all 0.3s ease-in 0s;
        background-image: -moz-linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 100%);
        background-image: -webkit-linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 100%);
        background-image: -o-linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 100%);
        background-image: linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 100%);
    }
    .onoffswitch3-checkbox:checked + .onoffswitch3-label .onoffswitch3-inner {
        margin-left: 0;
    }
    .onoffswitch3-checkbox:checked + .onoffswitch3-label .onoffswitch3-switch {
        right: 0px;
    }
</style>





