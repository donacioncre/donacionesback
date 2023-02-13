<!-- Ask Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Titulo:') !!}
    <p>{{ $donation->title }}</p>
   
</div>

<!-- Answer Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('details', 'Detalle:') !!}
    <p>{{ $donation->details }}</p>
</div>

@foreach ($donation->requirement_details as $key=> $item)
    <div class="form-group col-sm-4">
        {!! Form::label('points', 'Punto:') !!}
        <p>{{ $item->points }}</p>
    
    </div>
    <div class="form-group col-sm-5">
        {!! Form::label('points_details', 'Detalles:') !!}
        <p>{{ $item->points_details }}</p>
     
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


