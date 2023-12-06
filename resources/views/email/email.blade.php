<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <div style="background-color: #f5f5f5; padding: 20px; text-align: center;">
        <!-- Add your logo image here -->
        <img src="{{ $message->embed(public_path().'/logo.png') }}" height="200px" width="200px" class="logo" alt="Hammam Boulaaba Logo">
        
        <h1 style="color: #333; font-family: Arial, sans-serif;">Bienvenue chez Hammam Boulaaba</h1>
        <p style="color: #555;">Cher(e) {{ $user->name }},</p>
        <p style="color: #555;">Merci de rejoindre notre communauté !</p>
        <p style="color: #555;">Votre compte a été créé avec succès.</p>
        <p style="color: #555;">Si vous avez des questions ou avez besoin d'aide, n'hésitez pas à nous contacter.</p>
        <p style="color: #555;">Cordialement,<br>L'équipe Hammam Boulaaba</p>
    </div>
</body>
</html>
