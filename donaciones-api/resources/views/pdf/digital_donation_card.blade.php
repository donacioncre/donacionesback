<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .table-profile td{
            padding-left: 4px;
            padding-right: 4px;
            /*border: 1px solid #66B2AC;*/
            text-align: center;
            font-size: 16px
        }
        .table-profile th{
            text-align: right;
            /* background-color:#DDA466; */
            padding-left: 4px;
            padding-right: 4px;
            /* border: 1px solid #66B2AC; */
           
            
        }

        .table-donation tr th{
           
            /* background-color:#DDA466; */
            padding: 6px 0px 5px 0px ;
            border: 1px solid black;
            color: white; 
            text-align: center;  
            font-size: 26px;
            font-weight: 500;
            width: 165px;
        }

       .table-donation  tr td{
           /* padding-left: 4px;
            padding-right: 4px;*/
            padding: 10px 1px 10px 1px ;
            border: 1px solid black;
            text-align: center;
            font-size: 24px
        }
       
        .first{
          border: 1px solid #66B2AC;
          border-radius: 0px 0px 0px 0px;
        }

        .logoCruz{
          
          width: 550px;
          height: 100px;
         
        }

        html {
            font-family: 'Vollkorn', serif;
            font-weight: 400;
            line-height: 1.3;
            font-size: 16px;
        }

        body {
            margin=0;
            padding=0;
        }

        .siteTitle {
            display: block;
            font-weight: 900;
            font-size: 30px;
            margin: 20px 0;
        
        
        }

        header,
        main,

        .subtitle {
            color: #b0215e;
            text-align: center;
        }

        td .labels{
            font-weight: 800;
            font-size: 34px
        }

        td .text-card{
            font-size: 34px
        }

        

        .content {
            position: absolute;
           
            top: 0;
            left: 0;
            right: 0;
            margin: 0 auto;
           
        }

        .imgRedonda {
            width:300px;
            height:300px;
            border-radius:150px;
        }


    </style>
</head>
<body >

    <div class="img-triangle" style="margin-bottom: -50px">
        <img style="width: 500px;height: 900px; margin-top: -200px; margin-left: 655px" class="" src="{{public_path('/icon/triangle-PhotoRoom.png')}}"  alt="">
    </div>
    <div class="content">
     
        <div class="row" style="width: 100%" >
            <div class="container">
                   <div class="table-responsive col-md-12 col-sm-12">
                    <table id="dataTable"  class="table table-profile table-hover" >
                        <thead>
                            <tr>
                                <th style="margin-left: -20px"> <img class="logoCruz" src="{{public_path('/icon/logotipo_cre.png')}}"  alt=""> </th>
                                <th >   <span  style="margin-left:80px; font-size: 30px" > Carné digital de donación</span>  </th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr >
                                <td style="text-align: left; padding-left: 20px">  
                                    <br> <br> <br> <br> 
                                    <span class="labels" >Nombres: </span> <span class="text-card"> {{$data['user']->firstname }}</span> <br> <br> <br>
                                    <span class="labels">Apellidos: </span>   <span class="text-card">{{$data['user']->lastname}}</span> <br> <br> <br>
                                    <span class="labels">No. Cédula: </span>   <span class="text-card">{{$data['user']->identification}}</span> <br> <br> <br>
                                    <span class="labels">Fecha de emisión: </span>   <span class="text-card">{{$data['user']->created_at->format('Y-m-d')}}</span> <br> <br> <br>
                                    <span class="labels"> Tipo de sangre: </span>   <span class="text-card">{{$data['user']->blood_type}}</span> <br> <br> <br>
                                </td>
                                <td>  
                                    <img class="imgRedonda" src="{{public_path($data['user']->profile_picture)}}"  alt="">
                                </td>
                               
                            </tr>
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <br>
    <div class="contentt" style="margin-top: 50%">
        <div class="row" style="width: 100%">
            <div class="container">
                <img class="logoCruz" src="{{public_path('/icon/logotipo_cre.png')}}"  alt="">
                <br> <br>
                <div class="table-responsive col-md-12 col-sm-12">
                    <table id="dataTable"  class="table-donation " >
                        <thead style="background-color: red">
                            <tr>
                                <th>Código de Donación</th>
                                <th>Fecha de Donación</th>
                                <th>Hemoglobina</th>
                                <th >Peso</th>
                                <th>Presión arterial</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['donation_history'] as $donation)
                                <tr>
                                    <td>{{$donation->code}}</td>
                                    <td>{{$donation->schedule->donation_date}}</td>
                                    <td>{{$donation->hemoglobin}}</td>
                                    <td>{{$donation->weight}}</td>
                                    <td>{{$donation->blood_pressure}}</td>
                                    <td>{{$donation->schedule->type_donation}}</td>
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
      
    </div>
</body>
