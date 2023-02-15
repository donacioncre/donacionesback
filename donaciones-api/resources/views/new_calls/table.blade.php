<div class="table-responsive">
    <table class="table  table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]' >
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Autor</th> 
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($newCalls as $newCall)
            <tr>
                <td>{{ $newCall->title }}</td>
            <td>{{ $newCall->description }}</td>
            <td><img src="{{ asset($newCall->image) }}" class="img-thumbnail" style="height: 20%; width: 30%;"></td>
            <td>{{ $newCall->user->firstname  .' '. $newCall->user->lastname}}</td>
                <td width="120">
                    {!! Form::open(['route' => ['newCalls.destroy', $newCall->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('newCalls.show', [$newCall->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('newCalls.edit', [$newCall->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Esta seguro que quiere eliminar este registro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<style>
    

    
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        
       

        $('#dataTable').DataTable({
                    dom: "Blfrtip",
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json'
                    },    
                    buttons: [  ]                
        });

    });
</script>