<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre Rol') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('permission', 'Permisos del  Rol') !!}
    <br>
    @foreach($permission as $value)
        <label for="permission">
            {!! Form::checkbox('permission[]',$value->id,in_array($value->id,$rolePermissions)? true : false, ['class' => 'name']) !!}
            {{$value->name}} 
        </label> 
        <br>
    @endforeach
 
</div>


