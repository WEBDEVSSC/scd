<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <style>
        @page {
            margin: 0.5cm 0.5cm 0.5cm 0.5cm;
        }
        /* Estilo para tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        body {
            font-family: Arial, sans-serif; /* Cambiar la fuente a Arial */
            font-size: 12pt; /* Tamaño de la fuente */
            margin: 0;
            padding: 0;
            position: relative;
        }

        h1 {
            font-family: 'Times New Roman', serif; /* Fuente diferente para los encabezados */
        }

        p {
            font-family: 'Helvetica';
            font-size: 16px;
        }

        h9 {
            font-family: 'Helvetica';
            font-size: 12px;
        }

        /* Estilo para el encabezado */
        #header {
            position: fixed;
            top: 0cm;
            left: 0cm;
        }

        .imgHeader {
            float: center;
            width: 80%;
        }

        .infoHeader {
            float: left;
            width: 3cm;
        }

        /* Estilo para el pie de página */
        #footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            width: 100%;
        }

        #container
        {
            position: fixed;
            top: 2.5cm;
            /*bottom: 0cm;
            left: 0cm;
            width: 100%;*/
        }

    </style>
</head>
<body>
    <!-- ------------------------------------------------------ -->
    <div id="header">
        <!-- <img src="{{ public_path('img/CABECERA.jpg') }}" alt="Encabezado" width="80%"> -->
        <center><img class="imgHeader" src="{{ public_path('img/CABECERA.jpg') }}"></center>
    </div>
    <!-- ------------------------------------------------------ -->

    <!-- Contenido principal -->
    <div id="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-right">
                    Saltillo, Coahuila a {{$documento->created_at->format('d-m-Y')}}
                    <br>{{ $documento->siglas }}/{{ $documento->tipo }}/{{ $documento->consecutivo }}/{{ $documento->created_at->format('Y') }}
                    <br><strong>Asunto</strong> :  {{$documento->asunto}}
                </p>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-12">
                <p>{{ $documento->para_label }}<br><small><strong>{{ $documento->para_area }}</strong></small></p>
            </div>
        </div>
    
        <p>{!! $documento->contenido !!}</p>
    
        <div class="row">
            <div class="col-md-12">
                <center>
                    <p>ATENTAMENTE</p>

                    @if ($documento->status_firma == 1)

                        <p><img src="{{ public_path($usuario->firma) }}" alt="Firma" style="max-width: 300px; height: auto;"></p>

                    @else

                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>

                    @endif

                    
                    <p>{{ $documento->firma_area }}<br><strong>{{ $documento->firma_label }}</strong></p>
                </center>
            </div>
        </div>
    </div>

    <!-- ------------------------------------------------------ -->
    <div id="footer">
        <table style="border: 2px solid white; border-collapse: collapse;">
            <tr>
                <td width="80" style="border: 2px solid white;">
                    <img src="{{ public_path('img/C.jpg') }}" alt="Logo Footer" width="100%">
                </td>
                <td>
                    <h9>
                        Calle Victoria 312, Zona Centro 25000 <br>
                        Saltillo, Coahuila de Zaragoza <br>
                        Teléfono : (844) 438-8330 <br>
                        www.saludcoahuila.gob.mx
                    </h9>
                </td>
            </tr>
        </table>
    </div>
    <!-- ------------------------------------------------------ -->

</body>
</html>
