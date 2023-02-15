<div class="table-responsive">
    <table class="table  table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]' >
        <thead>
        <tr>
            <th>Donante</th>
            <th>Identificación C.I.</th>
            <th>Código</th>
            <th>Hemoglobina</th>
            <th>Peso</th>
            <th>Presión Arterial</th>
            <th>Nota</th>
            <th>Estado</th>
            <th >Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($donationHistories as $donationHistory)
            <tr>
                <td>
                    {{$donationHistory->schedule->user->firstname}}
                    {{$donationHistory->schedule->user->lastname}} 
                   
                </td>
                <td>
                    {{$donationHistory->schedule->user->identification}}
                </td>
                <td>{{ $donationHistory->code }}</td>
                <td>{{ $donationHistory->hemoglobin }}</td>
                <td>{{ $donationHistory->weight }}</td>
                <td>{{ $donationHistory->blood_pressure }}</td>
                <td>{{ $donationHistory->note }}</td>
                <td>{{  $donationHistory->status == 1 ? 'Habilitado' : 'Deshabilitado' }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['histories.destroy', $donationHistory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('histories.show', [$donationHistory->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('histories.edit', [$donationHistory->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {{-- {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
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