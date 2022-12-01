<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        td{
            padding-left: 4px;
            padding-right: 4px;
            /*border: 1px solid #66B2AC;*/
            text-align: center;
            font-size: 16px
        }
        th{
            text-align: right;
            /* background-color:#DDA466; */
            padding-left: 4px;
            padding-right: 4px;
            /* border: 1px solid #66B2AC; */
           
            
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


        .card {
        height: 400px;
        position: relative;
        padding: 20px;
        box-sizing: border-box;
        display: flex;
        align-items: flex-end;
        text-decoration: none;
        /*border: 4px solid #b0215e;*/
        margin-bottom: 20px;
        
        background-size: cover;
        
        
        }

        .inner {
        height: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center; 
        background: white;
        box-sizing: border-box;
        padding: 40px;
        
        
        }

        .title {
        font-size: 24px;
        color: black;  
        text-align: center;
        font-weight: 700;
        color: #181818;
        text-shadow: 0px 2px 2px #a6f8d5;
        position: relative;
        margin: 0 0 20px 0;
        

        }

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

        .img-triangle{
            position:relative;
           
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
                    <table id="dataTable"  class="table table-hover" >
                        <thead>
                            <tr>
                                <th> <img class="logoCruz" src="{{public_path('/icon/logotipo_cre.png')}}"  alt=""> </th>
                                <th >   <span  style="margin-left:80px; font-size: 30px" > Carné digital de donación</span>  </th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr >
                                <td style="text-align: left;">  
                                    <br> <br> <br> <br> 
                                    <span class="labels" >Nombres: </span> <span class="text-card"> {{$data->firstname }}</span> <br> <br> <br>
                                    <span class="labels">Apellidos: </span>   <span class="text-card">{{$data->lastname}}</span> <br> <br> <br>
                                    <span class="labels">No. Cédula: </span>   <span class="text-card">{{$data->identification}}</span> <br> <br> <br>
                                    <span class="labels">Fecha de emisión: </span>   <span class="text-card">{{$data->created_at->format('Y-m-d')}}</span> <br> <br> <br>
                                    <span class="labels"> Tipo de sangre: </span>   <span class="text-card">{{$data->blood_type}}</span> <br> <br> <br>
                                </td>
                                <td>  
                                    <img class="imgRedonda" src="{{public_path($data->profile_picture)}}"  alt="">
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
                <div class="table-responsive col-md-12 col-sm-12">
                    <table id="dataTable"  class="table table-hover" >
                        <thead>
                            <tr>
                                <th>Código de Donación</th>
                                <th>Fecha de Donación</th>
                                <th>Hemoglobina</th>
                                <th>Peso</th>
                                <th>Presión arterial</th>
                            </tr>
                        </thead>
                        <tbody>
        
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
      
    </div>
</body>
