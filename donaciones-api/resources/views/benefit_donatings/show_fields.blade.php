<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Titulo:') !!}
    <p>{{ $benefitDonating->title }}</p>
</div>

<!-- Details Field -->
<div class="col-sm-12">
    {!! Form::label('details', 'Detalles:') !!}
    <p>{{ $benefitDonating->details }}</p>
</div>


        <!-- Points Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('points', 'Puntos:') !!}
        @foreach ($benefitDonating->donation_details as $item)
            <p>{{ $item->points}}</p>
        @endforeach
    </div>


<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Fecha de Creación:') !!}
    <p>{{ $benefitDonating->created_at }}</p>
</div>


