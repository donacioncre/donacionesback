<!-- Ask Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Titulo:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Answer Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('details', 'Detalle:') !!}
    {!! Form::textarea('details', null, ['class' => 'form-control']) !!}
</div>

@foreach ($donation->requirement_details as $key=> $item)
    <div class="form-group col-sm-4">
        {!! Form::label('points', 'Punto:') !!}
        {!! Form::text('item[' .$key.  '][points]', $item->points, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('points_details', 'Detalles:') !!}
        {!! Form::text('item[' .$key.   '][points_details]', $item->points_details, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('image', 'Imagen:') !!}
        <div class="input-group">
            <div class="custom-file">
                {!! Form::file('item[' .$key.   '][image]' ,['class' => 'custom-file-input']) !!}
                {!! Form::label('image', 'Elegir Imagen', ['class' => 'custom-file-label']) !!}
            </div>
        </div>
    </div>
@endforeach