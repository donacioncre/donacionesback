<div class="table-responsive">
    <table class="table" id="roles-table">
        <thead>
        <tr>
            <th>Rol</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $rol)
            <tr>
                <td>{!! $rol->name !!}</td>
                <td width="120">
                    {!! Form::open(['route' => ['roles.destroy', $rol->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                       
                        <a href="{{ route('roles.edit', [$rol->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination justify-content-end">
        {{-- {{$roles->links()}} --}}
    </div>
</div>
