<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Titulo:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('blood_type', 'Tipo de Sangre:') !!}
    {!! Form::text('blood_type', null, ['class' => 'form-control']) !!}
</div>
<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date', 'Fecha:') !!}
    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
</div>


<div class="clearfix"></div>


<!-- Author Field -->
<div class="form-group col-sm-6">
    {!! Form::label('donation_id', 'Centro de Donación:') !!}
    {!! Form::select('donation_id', $donations,null, ['class' => 'form-control']) !!}
  
</div>

<div class="form-group col-md-4 col-sm-4">
    <label for="Paternidad">Enviar notificación a todos los  usuarios (No) </label>
    <label for=""> O a los que viven en la misma provincia que del centro de donación (SI)</label>
    <div class="onoffswitch3">
        <input type="checkbox" name="send_notification" class="onoffswitch3-checkbox" id="notification"  >
        <label class="onoffswitch3-label" for="notification">
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
        content: "SI";
        padding-left: 10px;
        background-color: #2FCCFF;
        color: #FFFFFF;
    }
    .onoffswitch3-inner:after {
        content: "NO";
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