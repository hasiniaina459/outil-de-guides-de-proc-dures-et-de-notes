<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>Nouvelle note ajoutée</h2>
    <p><strong>Titre:</strong> {{ $note->note_title }}</p>
    <p><strong>Contenu:</strong></p>
    <p>{{ $note->content }}</p>
    <p><strong>Date:</strong> {{ $note->note_date->format('d/m/Y H:i') }}</p>
    <hr>
    <p style="font-size: 12px; color: #999;">Cet email a été envoyé automatiquement par l'application Outils de Guides.</p>
</body>
</html>
