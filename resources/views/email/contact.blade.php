<!DOCTYPE html>
<html>

<head>
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .email-container {
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .email-content {
            margin-bottom: 10px;
        }

        .email-content strong {
            font-weight: bold;
        }

        .email-content p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-content">
            <p><strong>Name:</strong> {{ $name }}</p>
        </div>
        <div class="email-content">
            <p><strong>Email:</strong> {{ $email }}</p>
        </div>
        <div class="email-content">
            <p><strong>Subject:</strong> {{ $subject }}</p>
        </div>
        <div class="email-content">
            <p><strong>Message:</strong></p>
            <p>{{ $messages }}</p>
        </div>
    </div>
</body>

</html>