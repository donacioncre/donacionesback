<div class="table-responsive">
    <table class="table" id="bloodDonationHours-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Dirección</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bloodDonationHours as $bloodDonationHour)
            <tr>
                <td>{{  $bloodDonationHour['name'] }}</td>
            <td>{{ $bloodDonationHour['city'] }}</td>
            <td>{{ $bloodDonationHour['address'] }}</td>
          
                <td width="120">
                    {!! Form::open(['route' => ['plateletDonationHours.destroy', $bloodDonationHour['id']], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('plateletDonationHours.show', [$bloodDonationHour['id']]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('plateletDonationHours.edit', [$bloodDonationHour['id']]) }}"
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