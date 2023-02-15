<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Titulo:') !!}
    <p>{{ $myths->title }}</p>
</div>

<!-- Details Field -->
<div class="col-sm-12">
    {!! Form::label('details', 'Detalles:') !!}
    <p>{{ $myths->details }}</p>
</div>

@foreach ($myths->myth_details as $key=> $item)
    <div class="form-group col-sm-4">
        {!! Form::label('points', 'Punto:') !!}
        <p>{{ $item->ask }}</p>
    
    </div>
    <div class="form-group col-sm-5">
        {!! Form::label('points_details', 'Detalles:') !!}
        <p>{{ $item->answer }}</p>
     
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('image', '.') !!}
        <div class="input-group">
            <div class="custom-file">
                <img src="{{ asset($item->image) }}" alt="" class="brand-image img-circle" style="width: 30%">
            </div>
        </div>
    </div>
@endforeach



<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Fecha de Creación:') !!}
    <p>{{ $myths->created_at }}</p>
</div>



