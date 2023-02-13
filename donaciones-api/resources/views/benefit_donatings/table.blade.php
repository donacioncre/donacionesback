<div class="table-responsive">
    <table class="table" id="benefitDonatings-table">
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Detalles</th>
            <th>Puntos</th>
            <th >Accción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($benefitDonatings as $benefitDonating)
            <tr>
                <td>{{ $benefitDonating->title }}</td>
                <td>{{ $benefitDonating->details }}</td>
                <td>
                    @if (count($benefitDonating->donation_details))
                        @foreach ( $benefitDonating->donation_details as $item)
                             {{ $item->points  }} <br> 
                        @endforeach
                        
                    @endif
                   
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['benefitDonatings.destroy', $benefitDonating->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('benefitDonatings.show', [$benefitDonating->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('benefitDonatings.edit', [$benefitDonating->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {{-- {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Esta seguro quer desea eliminar el registro?')"]) !!} --}}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
