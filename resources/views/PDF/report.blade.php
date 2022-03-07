<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Report</title>
</head>
<style>
    table {
        width: 100%;
        border: 1px solid #dddddd;
        border-spacing: 0px;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
        border: 1px solid white;
    }

</style>

<body>
    <h1>Reporte de Profesores</h1>
    <h4>Fecha de generación: {{ date('d/m/Y H:m:s') }}</h4>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Grado</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Titulo</th>
                <th>Total de estudiantes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professors as $value)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->last_names }}</td>
                    <td>{{ $value->grade_name }}</td>
                    <td>{{ $value->age }}</td>
                    <td>{{ $value->sex }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
