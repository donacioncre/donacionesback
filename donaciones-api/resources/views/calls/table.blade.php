<div class="table-responsive">
    <table class="table  table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]' >
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Tipo de Sangre</th>
            <th>Lugar</th>
            <th>Provincia - Ciudad</th> 
            <th>Fecha</th> 
            <th >Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($calls as $call)
            <tr>
                <td>{{ $call['title'] }}</td>
                <td>{{ $call['blood_type'] }}</td>
                <td>{{ $call['place'] }}</td>
                <td>{{ $call['country_city']}}</td>
                <td>{{ $call['start_date']}}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['calls.destroy', $call['id']], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('calls.show', [$call['id']]) }}"
                            class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('calls.edit', [$call['id']]) }}"
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
    

    div.dataTables_wrapper div.dataTables_length select {
        width: 40%;
        display: inline-block;
    }
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