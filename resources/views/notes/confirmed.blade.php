<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmed</title>
    <style>
        body {
            background-color: white;
            display: flex;
            justify-content: center;
        }

        .content {
            background-color: #2A5318;
            color: #D2F4E6;
            text-align: center;
            padding: 40px;
            border-radius: 25px;
            width: 40%;
        }
    </style>
</head>

<body>
    <div class="content">
        <h1>merci !</h1>
        <p>la note {{$note->note_title}} est marquée comme lu</p>
    </div>
</body>

</html>