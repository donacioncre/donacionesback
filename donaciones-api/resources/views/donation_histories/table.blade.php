<div class="table-responsive">
    <table class="table" id="donationHistories-table">
        <thead>
        <tr>
            <th>Code</th>
        <th>Hemoglobin</th>
        <th>Weight</th>
        <th>Blood Pressure</th>
        <th>Note</th>
        <th>Status</th>
            <th colspan="3">Action</th>
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
            <td>{{ $donationHistory->status }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['donationHistories.destroy', $donationHistory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('donationHistories.show', [$donationHistory->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('donationHistories.edit', [$donationHistory->id]) }}"
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
