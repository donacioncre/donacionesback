<div class="table-responsive">
    <table class="table  table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]' >
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th >Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($donations as $donation)
            <tr>
                <td>{{ $donation->name }}</td>
                <td>{{ $donation->city->name }}</td>

                <td>{{$donation->address}}</td>
                <td>{{$donation->phone}}</td>


                <td width="120">
                    {!! Form::open(['route' => ['schedule.destroy', $donation->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('schedule.show', [$donation->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        {{-- <a href="{{ route('schedule.edit', [$donation->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a> --}}
                      
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
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