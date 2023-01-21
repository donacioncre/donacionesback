<div class="table-responsive">
    <table class="table" id="schedule-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th colspan="3">Action</th>
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
