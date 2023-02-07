@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Puntos de Donación</h1>
                </div>
                <div class="col-sm-6">
                  
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <form action="{{url('consultDonation')}}" method="GET"  id="form-fechasVisitas"  enctype="multipart/form-data">
            <div class="col-md-12"></div>
                @csrf
                 <!-- 
                <div class="form-group col-md-2 col-sm-2">
                    <label for="Provincia">Provincia</label>
                    <input type="text" name="country_id"  class="form-control">
                </div>

               Country Id Field -->
                
    
                <div class="form-group col-sm-12">
                    <div class="col-sm-6">
                        {!! Form::label('donation_id', 'Seleccionar Provincia:') !!}
                        <select name="country_id" id="country_id" class="form-control "  >
                            <option value="">Seleccionar </option>
                            @foreach ($countries as $key=>$value)
                                @if (isset($input['country_id']))
                                    <option  @if($input['country_id'] == $value->id) selected  @endif  
                                        value="{{$value->id}}">
                                        {{$value->name}}
                                    </option>
                                @else
                                    <option value="{{$value->id}}">
                                        {{$value->name}}
                                    </option>
                                @endif
                               
                                    
                                
                               
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-2 col-sm-2">
                    <label for=""></label>
                    <button  class="btn btn-primary form-control submit" type="submit" value="SUBMIT"> Consultar</button>
                </div>
        </form>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <h2></h2>
                        <br> 
                        <div class="table-responsive">
                            <table  class="table table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]' >
                                <thead>
                                    <tr>
                                        <th>Nombre del Centro</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Ciudad</th>
                                        <th>Provincia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donations as $donation)
                                        <tr>
                                            <td>{{$donation->name}}</td>
                                            <td>{{$donation->address}}</td>
                                            <td>{{$donation->phone}}</td>
                                            <td>{{$donation->email}}</td>
                                            <td>{{$donation->city->name}}</td>
                                            <td>{{$donation->city->country->name}}</td>
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