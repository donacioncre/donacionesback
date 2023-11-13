<div class="table-responsive">
    <table class="table  table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]' >
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Detalle</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($donation as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->details }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['donationRequirements.destroy', $item->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('donationRequirements.show', [$item->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('donationRequirements.edit', [$item->id]) }}"
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
