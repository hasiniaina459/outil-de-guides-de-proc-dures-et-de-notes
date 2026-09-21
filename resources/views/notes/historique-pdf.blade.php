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
    <title>historique notes</title>
</head>

<body>
    <p><strong>historique notes</strong></p>
    <table>
        <thead>
            <tr>
                <th>title</th>
                <th>content</th>
                <th>status</th>
                <th>date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
            <tr>
                <td>{{ $note->note_title }}</td>
                <td>{{ $note->content }}</td>
                <td>{{ $note->note_status ? 'Lu' : 'non Lu'}}</td>
                <td>{{ $note->note_date->format('d/m/Y H:i')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>