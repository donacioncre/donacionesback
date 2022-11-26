<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        td{
            padding-left: 4px;
            padding-right: 4px;
            border: 1px solid #66B2AC;
            text-align: center;
            font-size: 11px
        }
        th{
            text-align: left;
            background-color:#DDA466;
            padding-left: 4px;
            padding-right: 4px;
            border: 1px solid #66B2AC;
            text-align: center;
            font-size: 12px
        }
        .first{
          border: 1px solid #66B2AC;
          border-radius: 0px 0px 0px 0px;
        }

        .logo{
          position: absolute;
          left: 28px;
          width: 160px;
          height: 60px;
          top: 20px;
        }

        @mixin media() {
            @media (min-width: 768px) {
                @content;
            }
        }

body, html {
  font-family: 'Vollkorn', serif;
  font-weight: 400;
  line-height: 1.3;
  font-size: 16px;
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






    </style>
</head>
<body>

    {{-- <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?> --}}

        <main>
            <a href="https://google.com" class="card">
                <div class="inner">
                <h2 class="title">Mit 117 Sachen durch Klugheimschen Basaltgebirge</h2>
                <time class="subtitle">03. März 2021<time>
                </div>
            </a>
        </main>
        
   
    
    <div class="content">
        <div class="row" style="width: 100%">
            <div class="container" style="text-align: left; background-color:white; padding: 8px 8px; border: 1px solid #66B2AC; margin-left: 2px; margin-right: 2px; text-align: center; font-size: 20px">
                               Cruz Roja Ecuatoriana Carné digital de donación
                    
                
            </div>

        </div>
        <div class="row" style="width: 100%">
            <div class="container" style="text-align: left; background-color:white; padding: 8px 8px; border: 1px solid #66B2AC; margin-left: 2px; margin-right: 2px; font-size: 20px">
                <span>Nombres {{$data->firstname .' '. $data->lastname}}</span> 
     
                {{-- <img class="logo" src="{{ Voyager::image($admin_logo_img) }}" alt=""> --}}
            </div>
        </div>
        <br>
        <div class="table-responsive col-md-12 col-sm-12">
            <table id="dataTable" style="page-break-before:auto;" class="table table-hover" >
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
</body>
