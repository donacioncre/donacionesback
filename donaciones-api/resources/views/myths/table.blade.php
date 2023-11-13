<div class="table-responsive">
    <table class="table" id="myths-table">
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Detalles</th>

            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($myths as $myth)
            <tr>
                <td>{{ $myth->title }}</td>
                <td>{{ $myth->details }}</td>

                <td width="120">
                    {!! Form::open(['route' => ['myths.destroy', $myth->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('myths.show', [$myth->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('myths.edit', [$myth->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Esta seguro que quiere eliminar el registro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
