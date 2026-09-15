<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Historique des procédures</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <p><strong>Historique des procédures</strong></p>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date</th>
                <th>Etat</th>
                <th>Services</th>
            </tr>
        </thead>
        <tbody>
            @foreach($procedures as $procedure)
            <tr>
                <td>{{ $procedure->procedure_title }}</td>
                <td>{{ $procedure->description }}</td>
                <td>{{ $procedure->add_date }}</td>
                <td>{{ $procedure->procedure_status == 1 ? 'en cours' : 'termine' }}</td>
                <td>
                    @foreach($procedure->services as $service)
                    {{ $service->service_name }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>