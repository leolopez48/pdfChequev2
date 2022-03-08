<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }

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

    .title {
        text-align: center;
    }

    .text-right {
        text-align: right !important;
    }

    p {
        margin: 0 !important;
        padding: 0 !important;
    }

</style>

<body>
    <table>
        <tr>
            <td colspan="4">
                <center>
                    <b>Tesorería municipal de El Paraíso</b>
                </center>
            </td>
        </tr>
        <tr>
            <td>Lugar y fecha</td>
            <td> {{ $check->dateLetters }}</td>
            <td class="text-right">Monto</td>
            <td>US${{ $check->amount }}</td>
        </tr>
        <tr>
            <td>Páguese a la orden de</td>
            <td colspan="3"> {{ $check->check_name }}</td>
        </tr>
        <tr>
            <td>La suma de</td>
            <td colspan="3">{{ $check->total_letters }}</td>
        </tr>
        <tr>
            <td colspan="4">
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>Cheque No.</td>
            <td colspan="3"> {{ $check->check_number }}</td>
        </tr>
        <tr>
            <td>Banco</td>
            <td> {{ $check->name_bank }}</td>
            <td>Cuenta No.</td>
            <td> {{ $check->account_number }}</td>
        </tr>
        <tr>
            <td>Tipo de fondo</td>
            <td colspan="3"> {{ $check->code }} {{ $check->document_name }}</td>
        </tr>
        <tr>
            <td>No. de proyecto</td>
            <td colspan="3"> {{ $check->number_project }}</td>
        </tr>
        <tr>
            <td colspan="4">Concepto</td>
        </tr>
        <tr>
            <td colspan="4"> {{ $check->concept }}</td>
        </tr>
    </table>

    <br>
    <table>
        <tr>
            <td>Documento</td>
            <td>Número</td>
            <td>Valor total</td>
            <td>Ret. renta</td>
            <td>Ret. IVA</td>
            <td>Val. Líquido</td>
        </tr>
        <tr>
            <td> {{ $check->document }}</td>
            <td> {{ $check->document }}</td>
            <td> {{ $check->document }}</td>
            <td> {{ $check->document }}</td>
            <td> {{ $check->document }}</td>
            <td> {{ $check->document }}</td>

        </tr>

    </table>

    <br>
    <table>
        <tr>
            <td colspan="9">CIFRADO PRESUPUESTARIO</td>
        </tr>
        <tr>
            <td>AÑO</td>
            <td>CODIGO PRESUPUESTARIO</td>
            <td>INSTITUCIÓN <br> EL PARAÍSO</td>
            <td>A.G.</td>
            <td>U.P.</td>
            <td>L.T.</td>
            <td>F.F.</td>
            <td>DEBE</td>
            <td>HABER</td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td colspan="7"> </td>
            <td> </td>
            <td> </td>
        </tr>

    </table>

    <br>
    <table>
        <tr>
            <td><br><br><br><br><br><br></td>
            <td><br><br><br><br><br><br></td>
            <td><br><br><br><br><br><br></td>
            <td><br><br><br><br><br><br></td>
            <td><br><br><br><br><br><br></td>
        </tr>
        <tr>
            <td>HECHO POR</td>
            <td>PRESUPUESTARIO</td>
            <td>AUTORIZADO</td>
            <td>VISTO BUENO</td>
            <td>RECIBI</td>
        </tr>
        <tr>
            <td> Mayra Lissethe Renderos</td>
            <td> Milagro Hernandez</td>
            <td> Oswald Sibrián Miranda</td>
            <td> Oscar Armando Joaquín</td>
            <td> </td>
        </tr>
    </table>

    <br>
    <table>
        <tr>
            <td colspan="2">
                <center><b>POR:</b> US${{ $check->amount }}</center>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Recibí de la Tesorería Municipal de Villa El Paraíso, Departamento de Chalatenango, la cantidad de:
                {{ $check->total_letters }} de los Estados Unidos de América ({{ $check->amount }}), en concepto
                de {{ $check->concept }}, egreso que hace la tesorería Municipal de Villa de El Paraíso de la Cuenta
                Corriente {{ $check->document_name }} No. {{ $check->account_number }}, {{ $check->name_bank }}
                y descargado del Cifrado del
                Presupuesto Municipal vigente.
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: right">Villa de El Paraíso, {{ $check->dateNumberLetters }}</td>
        </tr>
    </table>

    <br>
    <table>
        <tr>
            <td>
                Pago {{ $check->concept }}
            </td>
            <td>
                {{ $check->amount }}
            </td>
        </tr>
        <tr>
            <td>
                Menos el 10% de renta
            </td>
            <td>
                {{ $check->rent }}
            </td>
        </tr>
        <tr>
            <td>
                Líquido a recibir
            </td>
            <td>
                {{ $check->amount }}
            </td>
        </tr>
    </table>

    <br>
    <br>
    <br>
    <br>
    <b>F.________________________</b> <br>
    <p>
        Nombre: {{ $check->check_name }} <br>
        DUI: {{ $check->check_name }} <br>
        NIT: {{ $check->check_name }} <br>
        Dirección: {{ $check->check_name }}
    </p>

    <br>
    <br>
    <table>
        <tr>
            <td><br><br><br><br><br><br></td>
            <td><br><br><br><br><br><br></td>
        </tr>
        <tr>
            <td>AUTORIZADO</td>
            <td>VISTO BUENO</td>
        </tr>
        <tr>
            <td> Alcalde Municipal</td>
            <td> Síndico Municipal</td>
        </tr>
    </table>
</body>

</html>
