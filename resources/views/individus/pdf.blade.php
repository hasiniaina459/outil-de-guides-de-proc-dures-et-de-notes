<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche d'activité de {{ $individus->name }} {{ $individus->firstname }}</title>
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
    <p>Voici la liste des activités effectuées et en cours de {{ $individus->name }} {{ $individus->firstname }}</p>

    <p><strong>Service:</strong> {{ $individus->service->service_name ?? 'Aucun' }}</p>
    <p><strong>Nombre d'appels reçus:</strong> {{ $remind_number }}</p>

    <table>
        <thead>
            <tr>
                <th>Procédures effectuées</th>
                <th>Procédures non effectuées</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @forelse($procedure_eff as $procedure)
                    {{ $procedure->procedure_title }}<br>
                    @empty
                    Aucune
                    @endforelse
                </td>
                <td>
                    @forelse($procedure_neff as $procedure)
                    {{ $procedure->procedure_title }}<br>
                    @empty
                    Aucune
                    @endforelse
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>