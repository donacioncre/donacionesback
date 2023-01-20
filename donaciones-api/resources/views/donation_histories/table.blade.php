<div class="table-responsive">
    <table class="table" id="donationHistories-table">
        <thead>
        <tr>
            <th>Código</th>
            <th>Hemoglobina</th>
            <th>Peso</th>
            <th>Presión Arterial</th>
            <th>Nota</th>
            <th>Estado</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($donationHistories as $donationHistory)
            <tr>
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
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
