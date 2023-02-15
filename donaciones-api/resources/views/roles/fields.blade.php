<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre Rol') !!}
    {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
</div>

<div class="form-group col-sm-12">
    @foreach ($name as $item)
        {!! Form::label('permission', 'Permisos  '. $item) !!}
        <br>
        @foreach($permission as $value)
            @if ( explode("-", $value->name)[1] ==  $item)
                <label for="permission" style="font-weight: 400">
                    {!! Form::checkbox('permission[]',$value->id,in_array($value->id,$rolePermissions)? true : false, ['class' => 'name']) !!}
                    {{$value->name}} 
                </label> 
                <br>
            @endif
           
        @endforeach
    @endforeach
</div>


