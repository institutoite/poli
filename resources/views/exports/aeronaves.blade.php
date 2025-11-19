<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Aeronaves</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Reporte de Aeronaves</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Modelo</th>
                <th>Año</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aeronaves as $aeronave)
                <tr>
                    <td>{{ $aeronave->id }}</td>
                    <td>{{ $aeronave->nombre }}</td>
                    <td>{{ $aeronave->modelo }}</td>
                    <td>{{ $aeronave->anio }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>