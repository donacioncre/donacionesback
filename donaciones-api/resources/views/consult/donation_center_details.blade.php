@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Consulta Usuarios</h1>
                </div>
                <div class="col-sm-6">
                  
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        {!! Form::open(['route' => ['donationCenterDetails', $id], 'method' => 'get']) !!}
       
        {{-- <form action="{{url('donationCenterDetails',[$id])}}" method="GET"  id="form-donation"  enctype="multipart/form-data"> --}}
            @csrf
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-3">
                        {!! Form::label('donation_id', 'Seleccionar Usuario:') !!}
                        <select name="user_id" id="user_id" class="form-control "  >
                            <option value="">Seleccionar </option>
                            @foreach ($donors as $key=>$value)
                                @if (isset($input['user_id']))
                                    <option  @if($input['user_id'] == $value['id']) selected  @endif  
                                        value="{{$value['id']}}">
                                        {{$value['name']}} 
                                    </option>
                                @else
                                    <option value="{{$value['id']}}">
                                        {{$value['name']}} 
                                    </option>
                                @endif
                               
                                    
                                
                               
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="col-sm-3">
                        {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
                        {!! Form::date('date_start', $input['date_start'], ['class' => 'form-control']) !!}
                       
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('fecha_fin', 'Fecha Fin:') !!}
                        {!! Form::date('date_end', $input['date_end'], ['class' => 'form-control']) !!}
                       
                    </div>
                    <div class="form-group col-md-1 col-sm-1">
                        <label for=""></label>
                        <button  class="btn btn-primary form-control submit " style="margin-top: 20%;" type="submit" value="SUBMIT"> Consultar</button>
                    </div>
                </div>

            </div>
    
        {{-- </form> --}}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <h2></h2>
                        <br> 
                        <div class="table-responsive" style=" overflow-x: scroll;">
                            <table  class="table table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]' >
                                <thead>
                                    <tr>
                                        <th>Donador</th>
                                        <th>Cédula</th>
                                        <th>Código</th>
                                        <th>Hemoglobina</th>
                                        <th>Peso</th>
                                        <th>Presión Arterial</th>
                                        <th>Estado</th>
                                        <th>Fecha y hora de Donación</th>
                                        <th>Nota</th>
                                        <th>Tipo Donación</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $donationHistory)
                                        <tr>
                                            <td>{{ $donationHistory['name'] }}</td>
                                            <td>{{ $donationHistory['identification'] }}</td>
                                            <td>{{ $donationHistory['code'] }}</td>
                                            <td>{{ $donationHistory['hemoglobin'] }}</td>
                                            <td>{{ $donationHistory['weight'] }}</td>
                                            <td>{{ $donationHistory['blood_pressure'] }}</td>
                                            <td>{{  $donationHistory['status'] == 1 ? 'Habilitado' : 'Deshabilitado' }}</td>
                                            <td>{{ $donationHistory['date_time'] }}</td>
                                            <td>{{ $donationHistory['note'] }}</td>
                                            <td>{{ $donationHistory['donation_type'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

<style>
    .dataTables_length{
        padding-left: 10px;
    }

    .table{
        padding-top: 20px;
        width:100%
    }
</style>


<script>
  
    document.addEventListener('DOMContentLoaded', function () {
        
       
        let imageBase64 ='';

        var flagsUrl = '{{ URL::asset('icon/logotipo_cre.png') }}';

        toDataUrl(flagsUrl, function(myBase64) {
                imageBase64 =  myBase64; // myBase64 is the base64 string
        });

     

        $('#dataTable').DataTable({
                    dom: "Blfrtip",
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json'
                    },
                    
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            autoFilter: true,
                            sheetName: 'Exported data',
                            title: 'Cruz Roja Ecuatoriana',
                            messageTop: 'Centros  de Donaciones',
                        }, 
                        {
                            extend: 'pdfHtml5',
                            title: '.',
                            messageTop: 'Centros de Donaciones',
                            download: 'open',
                            customize: function ( doc ) {
                                doc.content.splice( 1, 0, {
                                    margin: [ -50, -50, 0, 10 ],
                                    alignment: 'center',
                                    //width: 100,
                                    //height: 60,
                                    fit: [300, 300],
                                    image: imageBase64
                                } );
                            }
                        }
                        ,
                    ]

                
        });

    });
                  
  
      function toDataUrl(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                var reader = new FileReader();
                reader.onloadend = function() {
                    callback(reader.result);
                }
                reader.readAsDataURL(xhr.response);
            };
            xhr.open('GET', url);
            xhr.responseType = 'blob';
            xhr.send();
        }
  
</script>