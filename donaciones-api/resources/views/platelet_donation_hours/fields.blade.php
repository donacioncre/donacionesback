
<!-- Donation Id Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-6">
        {!! Form::label('donation_id', 'Punto de Donación:') !!}
        <select name="donation_id" id="donation_id" class="form-control "  >
            <option value="">Seleccionar </option>
            @foreach ($pointsDonations as $key=>$value)
                <option value="{{$value['id']}}">{{$value['name']}}</option>
            @endforeach
        </select>
    </div>
</div>

@foreach ($weekdays as $key=> $value)
    <!-- days -->
    <div class="form-group col-sm-4">
        {!! Form::label('days', 'Dia:') !!}

        <select name="weekdays[]" id="{{'day_'.$key}}" class="form-control "  >
            <option value="">Seleccionar Dia</option>
            @foreach ($weekdays as $key=>$value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
    <div  class="form-group col-sm-2">
        {!! Form::label('start_time', 'Hora Inicio:') !!}
        <input type="time" class="form-control" name="start_time[]" value="08:00">
    </div>
    <div  class="form-group col-sm-2">
        {!! Form::label('end_time', 'Hora Fin:') !!}
        <input type="time" class="form-control" name="end_time[]" value="17:00">
    </div>

    <div  class="form-group col-sm-2">
        {!! Form::label('start_time', 'Hora Inicio:') !!}
        <input type="time" class="form-control" name="start_time_1[]"  id="monday" value="">
    </div>
    <div  class="form-group col-sm-2">
        {!! Form::label('end_time', 'Hora Fin:') !!}
        <input type="time" class="form-control" name="end_time_1[]"  id="monday" value="">
    </div>
    <!------------------------------------------------------------------->
@endforeach


<script>

    var disabled = [];
    var disableOptions = function () {

        $('option').prop('disabled', false);
        $.each(disabled, function(key, val){
            $('option[value="' + val + '"]').prop('disabled', true);
        });
    };

    $(document).on('change', 'select', function () {
        disabled = [];
        $('select').each(function(){
            if($(this).val() != 'none'){
                $('option').prop('disabled', false);
                disabled.push( $(this).val() );
            }
        });
        disableOptions();
    });
    
</script>
