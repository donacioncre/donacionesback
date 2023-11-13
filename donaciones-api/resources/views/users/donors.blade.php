@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Donantes</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-10">
                <div class="table-responsive" style="padding-top: 30px">
                    <table class="table table-striped table-bordered" id="dataTable"  data-order='[[ 0, "asc" ]]'>
                        <thead>
                            <tr>

                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Célular</th>
                                <th>Email</th>
                                <th>Tipo de sangre</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Ciudad</th>
                                <th>Provincia</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>

                                <td>{!! $user->firstname !!}</td>
                                <td>{!! $user->lastname !!}</td>
                                <td>{!! $user->identification !!}</td>
                                <td>{!! $user->phone_number !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td>{!! $user->blood_type  !!}</td>
                                <td>{!! $user->date_birth!!}</td>
                                <td>{!! $user->city!!}</td>
                                <td>{!! $user->country!!}</td>


                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination justify-content-end">
                        {{-- {{$users->links()}} --}}
                    </div>
                </div>


                <div class="card-footer clearfix">
                    <div class="float-right">

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

        console.log(flagsUrl);

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
                            messageTop: 'Lista de Donantes',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: '.',
                            messageTop: 'Lista de Donantes',
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
