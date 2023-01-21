
    <div class="row">

        <div class="form-group col-sm-3">
            {!! Form::label('donation_date', 'Fecha:') !!}
            <input type="date" class="form-control "  disabled value="{{$donationHistory->schedule->donation_date}}" name="donation_date" id="donation_date">

        </div>
        <div class="form-group col-sm-6">   
            {!! Form::label('schedule_id', 'Donante:') !!}
            <p>{{$donationHistory->schedule->user->firstname}}
                {{$donationHistory->schedule->user->lastname}}  - Identificación:
            {{$donationHistory->schedule->user->identification}}</p>
        </div>  
        <!-- Status Field -->
        <div class="form-group col-sm-3">
        <div class="form-check">
            {!! Form::hidden('status', 0, ['class' => 'form-check-input']) !!}
            {!! Form::checkbox('status', '1', null, ['class' => 'form-check-input']) !!}
            {!! Form::label('status', 'Estado de la Donación', ['class' => 'form-check-label']) !!}
        </div>
        </div>

        <!-- Code Field -->
        <div class="form-group col-sm-6">
        {!! Form::label('code', 'Código:') !!}
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Hemoglobin Field -->
        <div class="form-group col-sm-6">
        {!! Form::label('hemoglobin', 'Hemoglobina:') !!}
        {!! Form::text('hemoglobin', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Weight Field -->
        <div class="form-group col-sm-6">
        {!! Form::label('weight', 'Peso:') !!}
        {!! Form::text('weight', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Blood Pressure Field -->
        <div class="form-group col-sm-6">
        {!! Form::label('blood_pressure', 'Presión Arterial:') !!}
        {!! Form::text('blood_pressure', null, ['class' => 'form-control']) !!}
        </div>


        <!-- Note Field -->
        <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('note', 'Nota:') !!}
        {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
        </div>

    </div>

