<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>historique rappels</title>
</head>
<body>
    <p><strong>historique des rappels</strong></p>
    <table>
        <thead>
            <tr>
                <th>title</th>
                <th>date</th>
                <th>number max</th>
                <th>moyen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rappels as $rappel)
            <tr>
                <td>{{ $rappel->remind_title }}</td>
                <td>{{ $rappel->remind_date->format('d/m/Y H:i' )}}</td>
                <td>{{ $rappel->remind_number }}</td>
                <td>
                    @if($rappel->source === 'auto')
                    <span class="auto">auto</span>
                    @else
                    <span class="manuel">Manuel</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>