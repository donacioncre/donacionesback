
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('reference', 'Referencia:') !!}
    {!! Form::text('reference', null, ['class' => 'form-control','required']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('latitud', 'Latitud:') !!}
    {!! Form::text('latitude', null, ['class' => 'form-control','required']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('longitud', 'Longitud:') !!}
    {!! Form::text('longitude', null, ['class' => 'form-control','required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Dirección:') !!}
    {!! Form::text('address', null, ['class' => 'form-control','required']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Teléfono:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control','required']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Número de Whatsapp:') !!}
    {!! Form::text('whatsapp_number', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('correo', 'Correo:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('ciudad', 'Ciudad:') !!}
    {!! Form::select('city_id', $cities, null,['class' => 'form-control','id'=>'city_id' ,'required']) !!}
</div>

<div class="form-group col-md-4 col-sm-4">
    <label for="Paternidad">Estado del Centro </label>
    <div class="onoffswitch3">
        <input type="checkbox"  name="status" class="onoffswitch3-checkbox" id="status" 
            @isset($donation->status)
                @if ($donation->status == true)
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

