<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Historique des comptes</title>
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
    <p><strong>Historique des comptes</strong></p>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Service</th>
            </tr>
        </thead>
        <tbody>
            @foreach($individus as $individu)
            <tr>
                <td>{{ $individu->name }}</td>
                <td>{{ $individu->firstname }}</td>
                <td>{{ $individu->email }}</td>
                <td>{{$individu->service->service_name ?? 'aucun'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>