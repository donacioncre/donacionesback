<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <title> Welcome to [Coded Mails] </title>
    <!--[if !mso]> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
      #outlook a {
        padding: 0;
      }
  
      body {
        margin: 0;
        padding: 0;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
      }
  
      table,
      td {
        border-collapse: collapse;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }
  
      img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }
  
      p {
        display: block;
        margin: 13px 0;
      }
    </style>
  
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet" type="text/css" />
    <style type="text/css">
      @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,700);
    </style>
    <!--<![endif]-->
    <style type="text/css">
      @media only screen and (min-width:480px) {
        .mj-column-per-100 {
          width: 100% !important;
          max-width: 100%;
        }
      }
    </style>
    <style type="text/css">
      @media only screen and (max-width:480px) {
        table.mj-full-width-mobile {
          width: 100% !important;
        }
  
        td.mj-full-width-mobile {
          width: auto !important;
        }
      }
    </style>
    <style type="text/css">
      a,
      span,
      td,
      th {
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
      }
    </style>
</head>
  
  <body style="background-color:#f3f3f5;">
    <div style="display:none;font-size:1px;line-height:1px;max-height:0px;
            max-width:0px;opacity:0;overflow:hidden;margin-top: 20px">  </div>
    <div style="background-color:#f3f3f5;">
      <div style="background:white;background-color:white;
                      margin: auto; border-radius:4px 4px 0 0;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" 
              style="background:white;background-color:white;width:100%;border-radius:4px 4px 0 0;">
          <tbody>
            <tr>
              <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
               
                <div class="mj-column-per-100 mj-outlook-group-fix" 
                style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                    <tbody><tr>
                      <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" 
                        style="border-collapse:collapse;border-spacing:0px;">
                          <tbody>
                            <tr>
                              <td style="width:380px;">
                                <img height="auto" src="{{asset('/icon/logotipo_cre.png')}}"
                                  style="border:0;display:block;outline:none;text-decoration:none;
                                  height:auto;width:100%;font-size:13px;" width="190" />
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size:0px;word-break:break-word;">
                        <div > </div>
                      </td>
                    </tr>
                    <tr>
                      <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:24px;font-weight:400;line-height:30px;text-align:left;">
                          <h1 style="margin: 0; font-size: 24px; line-height: normal; font-weight: normal;">
                            
                          </h1>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td align="left" style="font-size:0px;padding:10px 40px;word-break:break-word;">
                        <div style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;
                            line-height:20px;text-align:left">
                          <p style="margin-bottom: 0;">
                            Hola, {{$data['donation_center']}} has recibido un nuevo agendamiento de cita para
                            donar {{$data['donation_type']}}
                          
                          </p>
                          <p>
                            Detalle de la nueva Cita:  
                          </p>
                        </div>
                      </td>
                    </tr>
                   
                    <tr>
                      <td align="left" style="font-size:0px;padding:10px 40px;word-break:break-word;">
                        <div style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;
                            line-height:20px;text-align:left;">
                          <p style="margin-bottom: 0; font-weight: 800">
                            Datos personales:
                          </p>
                          <p style="margin-bottom: 0;">
                            <b>Nombres:</b> {{$data['name']}} <br>
                            <b>Apellidos:</b> {{$data['lastname']}} <br>
                            <b>Grupo Sanguíneo:</b> {{$data['blood_type']}} <br>
                            <b>Celular:</b> {{$data['phone_number']}} <br>
                            <b>Correo:</b> {{$data['user_email']}} <br>
                            <b>Fecha de nacimiento:</b> {{$data['date_birth']}}  <br>
                            <b>Provincia:</b> {{$data['country']}}  <br>
                            <b>Ciudad:</b> {{$data['city']}} <br>
                          </p>

                          <p style="margin-top: 20px;">
                            <b>Detalle del Hemocentro: </b> 
                          </p>
                          <p>
                            <b>Centro de donación:</b> {{$data['donation_center']}} <br>
                            <b>Dirección:</b> {{$data['address']}} <br>
                            <b>Tipo de Donación:</b> {{$data['donation_type']}} <br>
                            <b>Teléfono: </b>{{$data['phone']}} <br>
                            <b>Email:</b> {{$data['donation_email']}} <br>
                            <b>Fecha para la donación: </b>{{$data['donation_date']}} <br>
                            <b>Hora para la donación:</b> {{$data['donation_time']}} <br>
                          </p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td align="left" style="font-size:0px;padding:10px 40px;word-break:break-word;">
                        <div style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;
                            line-height:20px;text-align:left">
                          <p style="margin-bottom: 0;">
                           
                            <br>
                            <br>
                            <b>¡JUNTOS SALVAMOS VIDAS!
                              Cruz Roja Ecuatoriana</b>
                          </p>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  
      <div style="background:#ffffff;background-color:#ffffff;margin:0px auto;border-radius:0 0 4px 4px;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" 
              style="background:#ffffff;background-color:#ffffff;width:100%;border-radius:0 0 4px 4px;">
          <tbody>
            <tr>
              <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
               
                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                    <tbody><tr>
                      <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;
                        font-weight:400;line-height:20px;text-align:center;color:#93999f;">
                          © 2020 [Cruz Roja Ecuatoriana], All rights reserved <br /> 
                        
                            </div>
                      </td>
                    </tr>
                  
                  </tbody>
                </table>
                </div>
               
              </td>
            </tr>
          </tbody>
        </table>
      </div>
     
     
    </div>
  
  
  </body>
</html>