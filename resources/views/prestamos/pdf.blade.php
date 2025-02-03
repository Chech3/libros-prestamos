<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Préstamo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            padding: 20px;
            border: 1px solid #000;
            max-width: 600px;
        }
        h2 {
            text-align: center;
            text-transform: uppercase;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }
        p {
            font-size: 16px;
            margin: 8px 0;
        }
        .firma {
            margin-top: 50px;
            text-align: center;
        }
        .firma p {
            margin: 5px 0;
        }
        .nota {
            font-style: italic;
            margin-top: 20px;
            text-align: justify;
        }
    </style>
</head>
<body>

    <h2>Reporte de Préstamo</h2>
    <div>
        <p><strong> Libro:</strong> {{ $prestamo->libro->nombre_del_libro }}</p>
        <p><strong> Destinatario:</strong> {{ $prestamo->destinario->nombre ?? 'No disponible' }}</p>
        <p><strong> Fecha del Préstamo:</strong> {{ $prestamo->fecha_de_prestamo }}</p>
        <p><strong> Fecha de Devolución:</strong> {{ $prestamo->fecha_de_devolución }}</p>
    </div>

    <!-- Espacio para la firma -->
    <div class="firma">
        <p>_______________________________</p>
        <p>Firma del usuario</p>
    </div>

    <!-- Nota de compromiso -->
    <p class="nota">
        La persona <strong>{{ $prestamo->destinario->nombre ?? 'No disponible' }}</strong> 
        se compromete a devolver el libro en la fecha acordada.
    </p>

</body>
</html>
