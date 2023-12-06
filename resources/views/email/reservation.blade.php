<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Set table width to 100% for responsiveness */
        table {
            width: 100% !important;
        }

        body {
            width: 100% !important;

        }
    </style>
</head>


@php
    $dataUrl = "/codeqr_{$reservationId}";
    $encodedUrl = urlencode($dataUrl);
@endphp
<body>
    <div style="background-color: #f5f5f5; padding: 10px; text-align: center;">
        <!-- Add your logo image here -->
        <img src="{{ $message->embed(public_path('/logo.png')) }}" height="200px" width="200px" class="logo" alt="Hammam Boulaaba Logo">
        <div style="text-align: center; padding: 20px;">
        <img src="{{ route('generate-qr-code', ['data' => $encodedUrl]) }}" alt="QR Code" style="max-width: 200px;">
        </div>
        <h1 style="color: #333; font-family: Arial, sans-serif;">Confirmation de réservation</h1>
        <p style="color: #555;">Cher(e) {{ $user->name }},</p>
        <p style="color: #555;">
            {{ $greeting }}
        </p>
        @if (!empty($professionalMessage))
        <p style="color: #555;">{{ $professionalMessage }}</p>
        @endif

        <table style="border: 1px solid #ddd; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="padding: 10px; text-align: left;">Service</th>
                    <th style="padding: 10px; text-align: left;">Image</th>
                    <th style="padding: 10px; text-align: left;">Nombre de places</th>
                    <th style="padding: 10px; text-align: left;">Prix</th>
                    <th style="padding: 10px; text-align: left;">Début</th>
                    <th style="padding: 10px; text-align: left;">Fin</th>
                    <th style="padding: 10px; text-align: left;">Sous-total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($selectedItems as $item)
                <tr>
                    <td style="padding: 10px;">{{ $item['service_name'] }}</td>
                    <td style="padding: 10px;">
                        <img src="{{ $message->embed($item['imageEmail']) }}" height="100" width="100" alt="{{ $item['service_name'] }}">
                    </td>
                    <td style="padding: 10px;">{{ $item['nombre_de_place'] }}</td>
                    <td style="padding: 10px;">{{ $item['prix'] }}</td>
                    <td style="padding: 10px;">{{ $item['start'] }}</td>
                    <td style="padding: 10px;">{{ $item['end'] }}</td>
                    <td style="padding: 10px;">{{ $item['subtotal'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p style="color: #555;">Numéro de réservation : {{ $reservationId }}</p>


        <p style="color: #555;">Si vous avez des questions ou avez besoin d'aide, n'hésitez pas à nous contacter.</p>
        <p style="color: #555;">Cordialement,<br>L'équipe Hammam Boulaaba</p>
    </div>
</body>

</html>