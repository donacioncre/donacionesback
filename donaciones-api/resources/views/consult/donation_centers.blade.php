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
                        {!! Form::label('donation_id', 'Punto de Donación:') !!}
                        <select name="country_id" class="form-control "  >
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
                            <table id="dataTable" class="table table-hover" data-order='[[ 0, "desc" ]]' >
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



@section('scripts')

  <!-- DataTable -->
 
  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
  

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript" defer></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js" defer></script>



@endsection

<script>
  
    document.addEventListener('DOMContentLoaded', function () {
         
          $('#dataTable').DataTable({
                      dom: "Blfrtip",
  
                      buttons: [
                            'excel', 'pdf',
                        ]
  
                  });
      });
                  
  
  
  </script>