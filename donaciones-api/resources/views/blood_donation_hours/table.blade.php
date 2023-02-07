<div class="table-responsive">
    <table class="table  table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]' >
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Dirección</th>
            <th >Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bloodDonationHours as $bloodDonationHour)
            <tr>
            <td>{{  $bloodDonationHour['name'] }}</td>
            <td>{{ $bloodDonationHour['city'] }}</td>
            <td>{{ $bloodDonationHour['address'] }}</td>
          
                <td width="120">
                    {!! Form::open(['route' => ['bloodDonationHours.destroy', $bloodDonationHour['id']], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('bloodDonationHours.show', [$bloodDonationHour['id']]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('bloodDonationHours.edit', [$bloodDonationHour['id']]) }}"
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

@php

 function nameDay($nameDay)
    {
        $data=[
            'Lunes' =>'1',
            'Martes' =>'2',
            'Miercoles' =>'3',
            'Jueves'=>'4',
            'Viernes'=>'5',
            'Sabado'=>'6',
            'Domingo'=>'0'
        ];

        return array_search($nameDay,$data);
    }
@endphp

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