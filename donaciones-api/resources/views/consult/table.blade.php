<div class="table-responsive">
    <table class="table" id="questions-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Longitud</th>
            <th>Latitud</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($donations as $donation)
            <tr>
                <td>{{ $donation->name }}</td>
                <td>{{ $donation->city->name }}</td>
                <td>{{$donation->longitude}}</td>
                <td>{{$donation->latitude}}</td>
                <td>{{$donation->address}}</td>
                <td>{{$donation->phone}}</td>
                <td>{{$donation->email}}</td>

                <td width="120">
                    {!! Form::open(['route' => ['donation.destroy', $donation->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('donation.show', [$donation->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('donation.edit', [$donation->id]) }}"
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
