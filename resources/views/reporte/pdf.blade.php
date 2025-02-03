<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Libros por Categoría</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
        }
        .header h2 {
            font-size: 16px;
            margin: 0;
            color: gray;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Libros</h1>
        <h2>Categoría: {{ $categoria->nombre }}</h2>
    </div>
    @if ($libros->isEmpty())
        <h2 style="text-align: center">No hay libros registrados en esta categoría.</h2>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del Libro</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($libros as $index => $libro)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $libro->nombre_del_libro }}</td>
                        <td>{{ $libro->nombre_del_autor }}</td>
                        <td>{{ $libro->ISBN }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
