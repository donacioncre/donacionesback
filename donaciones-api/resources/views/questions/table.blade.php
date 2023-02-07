<div class="table-responsive">
    <table class="table  table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]' >
        <thead>
        <tr>
            <th>Pregunta</th>
            <th>Respuesta</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($questions as $questions)
            <tr>
                <td>{{ $questions->ask }}</td>
                <td>{{ $questions->answer }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['questions.destroy', $questions->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('questions.show', [$questions->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('questions.edit', [$questions->id]) }}"
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
