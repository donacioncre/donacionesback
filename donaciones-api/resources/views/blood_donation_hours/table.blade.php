<div class="table-responsive">
    <table class="table" id="bloodDonationHours-table">
        <thead>
        <tr>
            <th>Days</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Donation Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bloodDonationHours as $bloodDonationHour)
            <tr>
                <td>{{  nameDay($bloodDonationHour->days) }}</td>
            <td>{{ $bloodDonationHour->start_time }}</td>
            <td>{{ $bloodDonationHour->end_time }}</td>
            <td>{{ $bloodDonationHour->donation->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['bloodDonationHours.destroy', $bloodDonationHour->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('bloodDonationHours.show', [$bloodDonationHour->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('bloodDonationHours.edit', [$bloodDonationHour->id]) }}"
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