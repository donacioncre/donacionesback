<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Titulo:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Details Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('details', 'Detalles:') !!}
    {!! Form::textarea('details', null, ['class' => 'form-control' , 'rows'=>'3']) !!}
</div>

@foreach ($myths->myth_details as $key=> $item)
    <div class="form-group col-sm-4">
        {!! Form::label('points', 'Punto:') !!}
        {!! Form::textarea('item[' .$key.  '][ask]', $item->ask, ['class' => 'form-control', 'rows'=>'3', ]) !!}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('points_details', 'Detalles:') !!}
        {!! Form::textarea('item[' .$key.   '][answer]', $item->answer, ['class' => 'form-control' , 'rows'=>'3']) !!}
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



<div class="clearfix"></div>
