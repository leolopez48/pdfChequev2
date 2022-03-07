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
    <h1>Reporte de estudiantes según nota final</h1>
    <h4>Fecha de generación: {{ date('d/m/Y H:m:s') }}</h4>

    <h3>Nota entre 1 y 3</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Carnet</th>
                <th>Grado</th>
                <th>Nombre del padre</th>
                <th>Nombre de la madre</th>
                <th>Edad</th>
                <th>Nota final</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($firstGroup as $value)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->student_last_names }}</td>
                    <td>{{ $value->n_carnet }}</td>
                    <td>{{ $value->grade_name }}</td>
                    <td>{{ $value->father_name }}</td>
                    <td>{{ $value->mother_name }}</td>
                    <td>{{ $value->student_age }}</td>
                    <td>{{ $value->final_grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Nota entre 4 y 6</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Carnet</th>
                <th>Grado</th>
                <th>Nombre del padre</th>
                <th>Nombre de la madre</th>
                <th>Edad</th>
                <th>Nota final</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($secondGroup as $value)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->student_last_names }}</td>
                    <td>{{ $value->n_carnet }}</td>
                    <td>{{ $value->grade_name }}</td>
                    <td>{{ $value->father_name }}</td>
                    <td>{{ $value->mother_name }}</td>
                    <td>{{ $value->student_age }}</td>
                    <td>{{ $value->final_grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Nota entre 7 y 10</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Carnet</th>
                <th>Grado</th>
                <th>Nombre del padre</th>
                <th>Nombre de la madre</th>
                <th>Edad</th>
                <th>Nota final</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($thirdGroup as $value)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->student_last_names }}</td>
                    <td>{{ $value->n_carnet }}</td>
                    <td>{{ $value->grade_name }}</td>
                    <td>{{ $value->father_name }}</td>
                    <td>{{ $value->mother_name }}</td>
                    <td>{{ $value->student_age }}</td>
                    <td>{{ $value->final_grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
