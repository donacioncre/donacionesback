<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th>Nombre Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cédula</th>
            <th>Célular</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Centro de Donación</th>
            <th colspan="2">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->firstname !!}</td>
                <td>{!! $user->lastname !!}</td>
                <td>{!! $user->identification !!}</td>
                <td>{!! $user->phone_number !!}</td>
                <td>{!! $user->email !!}</td>
                <td>

                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $rolName)
                            <span>{{$rolName}}</span>
                        @endforeach
                    @endif
                </td>
                <td>
                    @if(!empty( $user->donationCenter))
                        @foreach( $user->donationCenter as $donation)
                            <span>{{$donation->name}}</span>
                        @endforeach
                    @endif
                  
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                       
                        <a href="{{ route('users.edit', [$user->id]) }}"
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
    <div class="pagination justify-content-end">
        {{-- {{$users->links()}} --}}
    </div>
</div>
