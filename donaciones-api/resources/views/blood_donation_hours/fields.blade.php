
<!-- Donation Id Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-6">
        {!! Form::label('donation_id', 'Punto de Donación:') !!}
        {!! Form::select('donation_id', $pointsDonations, null, ['class' => 'form-control custom-select']) !!}
    </div>
</div>

<!-- Days Field -->
<div class="form-group col-sm-6">
    {!! Form::label('days', 'Dia:') !!}
    {!! Form::text('days[]','Lunes', ['class' => 'form-control']) !!}
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('start_time', 'Hora Inicio:') !!}
    <input type="time" class="form-control" name="start_time[]" value="08:00">
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('end_time', 'Hora Fin:') !!}
    <input type="time" class="form-control" name="end_time[]" value="17:00">
</div>
<!-- days -->
<div class="form-group col-sm-6">
    {!! Form::label('days', 'Dia:') !!}
    {!! Form::text('days[]','Martes', ['class' => 'form-control']) !!}
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('start_time', 'Hora Inicio:') !!}
    <input type="time" class="form-control" name="start_time[]" value="08:00">
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('end_time', 'Hora Fin:') !!}
    <input type="time" class="form-control" name="end_time[]" value="17:00">
</div>
<!------------------------------------------------------------------->
<!-- days -->
<div class="form-group col-sm-6">
    {!! Form::label('days', 'Dia:') !!}
    {!! Form::text('days[]','Miercoles', ['class' => 'form-control']) !!}
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('start_time', 'Hora Inicio:') !!}
    <input type="time" class="form-control" name="start_time[]" value="08:00">
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('end_time', 'Hora Fin:') !!}
    <input type="time" class="form-control" name="end_time[]" value="17:00">
</div>
<!------------------------------------------------------------------->

<!-- days -->
<div class="form-group col-sm-6">
    {!! Form::label('days', 'Dia:') !!}
    {!! Form::text('days[]','Jueves', ['class' => 'form-control']) !!}
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('start_time', 'Hora Inicio:') !!}
    <input type="time" class="form-control" name="start_time[]" value="08:00">
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('end_time', 'Hora Fin:') !!}
    <input type="time" class="form-control" name="end_time[]" value="17:00">
</div>
<!------------------------------------------------------------------->
<!-- days -->
<div class="form-group col-sm-6">
    {!! Form::label('days', 'Dia:') !!}
    {!! Form::text('days[]','Viernes', ['class' => 'form-control']) !!}
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('start_time', 'Hora Inicio:') !!}
    <input type="time" class="form-control" name="start_time[]" value="08:00"> 
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('end_time', 'Hora Fin:') !!}
    <input type="time" class="form-control" name="end_time[]" value="17:00">
</div>
<!------------------------------------------------------------------->

<!-- days -->
<div class="form-group col-sm-6">
    <input type="checkbox" class="" id="check_saturday" name="check_sunday">
    {!! Form::label('days', 'Dia:') !!}
    {!! Form::text('days[]','Sábado', ['class' => 'form-control','id'=>'saturday']) !!}
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('start_time', 'Hora Inicio:') !!}
    <input type="time" class="form-control" name="start_time[]" value="08:00" id="saturday_star">
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('end_time', 'Hora Fin:') !!}
    <input type="time" class="form-control" name="end_time[]" value="17:00" id="saturday_end">
</div>
<!------------------------------------------------------------------->

<!-- days -->
<div class="form-group col-sm-6">
    <input type="checkbox" class="" id="check_sunday" name="check_sunday">
    {!! Form::label('days', 'Dia:') !!}
    {!! Form::text('days[]','Domingo', ['class' => 'form-control', 'id'=>'sunday' ]) !!}
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('start_time', 'Hora Inicio:') !!}
    <input type="time" class="form-control" name="start_time[]" value="08:00" id="sunday_star">
</div>
<div  class="form-group col-sm-3">
    {!! Form::label('end_time', 'Hora Fin:') !!}
    <input type="time" class="form-control" name="end_time[]" value="17:00" id="sunday_end">
</div>
<!------------------------------------------------------------------->


<style>

</style>

<script>
    document.getElementById('sunday').disabled = !this.checked;
    document.getElementById('sunday_star').disabled = !this.checked;
    document.getElementById('sunday_end').disabled = !this.checked;
    document.getElementById('check_sunday').onchange = function() {
        document.getElementById('sunday').disabled = !this.checked;
        document.getElementById('sunday_star').disabled = !this.checked;
        document.getElementById('sunday_end').disabled = !this.checked;
    };
   

    document.getElementById('saturday').disabled = !this.checked;
    document.getElementById('saturday_star').disabled = !this.checked;
    document.getElementById('saturday_end').disabled = !this.checked;
    document.getElementById('check_saturday').onchange = function() {
        document.getElementById('saturday').disabled = !this.checked;
        document.getElementById('saturday_star').disabled = !this.checked;
        document.getElementById('saturday_end').disabled = !this.checked;
    };
   
</script>
