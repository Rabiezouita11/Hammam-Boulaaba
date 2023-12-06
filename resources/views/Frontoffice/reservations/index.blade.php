@extends('Frontoffice.layouts.index')

@section('content')
@php
    use Stichoza\GoogleTranslate\GoogleTranslate;
@endphp

{{-- Get the current locale --}}
@php
    $currentLocale = app()->getLocale();
@endphp

{{-- Create an instance of GoogleTranslate --}}
@php
    $translator = new GoogleTranslate();
    $translator->setTarget($currentLocale); // Set the target language based on the current locale
    $translatedLocale = $translator->translate(strtoupper(app()->getLocale()));

@endphp
<br>
<br>
<br>
<br>
<div class="container mt-5">
    <div class="text-center">
        <h2 class="mb-4">  {{ $translator->translate('Vos réservations') }} </h2>
    </div>

    @if (count($reservations) > 0)
    @foreach ($reservations as $reservation)
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">
            {{ $translator->translate('Reservation ID:') }}   {{ $reservation->id }}
                @if ($reservation->etat_confirmation === 'confirmer')
                <span class="badge badge-success">  {{ $translator->translate('Confirmé') }} </span>
                @elseif ($reservation->etat_confirmation === 'refuser')
                <span class="badge badge-danger">  {{ $translator->translate('Refusé') }} </span>
                @else
                <span class="badge badge-warning">  {{ $translator->translate('En attente') }} </span>
                @endif
            </h5>
        </div>
        <div class="card-body">
            <h5 class="card-title"> {{ $translator->translate('Services') }}  </h5>
            <ul class="list-group">
                @foreach ($reservation->elementDePanier as $element)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1">   {{ $translator->translate('Nom de service :') }}  {{ $translator->translate($element->panier->service->Designations) }} </p>
                            <p class="mb-1">  {{ $translator->translate(' Categorie de service :') }} {{ $translator->translate($element->panier->service->categories) }}  </p>

                            <img src="/storage/{{ $element->panier->service->image}}" alt="Service Image" class="service-image">
                            @if($currentLocale === 'ar')
                            <p class="mb-1">  عدد الأماكن   :  {{ $element->panier->nombre_de_place }}</p>


                            @else
                            <p class="mb-1"> {{ $translator->translate('Nombre de Place:') }}   {{ $element->panier->nombre_de_place }}</p>


                            @endif
                            <p class="mb-1"> {{ $translator->translate('Montant Total:') }}  {{ $element->panier->montant_total }} {{ $translator->translate('TND') }} </p>
                            <p class="mb-1"> {{ $translator->translate('Date de debut :') }}  {{ $element->panier->start }}</p>
                            <p class="mb-1">{{ $translator->translate('Date de fin :') }}  {{ $element->panier->end }}</p>

                        </div>
                        <div>
                            <!-- Add more actions or details specific to each element here if needed -->
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach
    @else
    <div class="card mb-4 mx-auto" style="width: 600px; height: 400px;">
        <div class="card-body d-flex justify-content-center align-items-center">
            <p class="card-text text-center" style="font-size: 24px;">  {{ $translator->translate(' Vous n\'avez aucune réservation à afficher.') }}</p>
        </div>
    </div>
    @endif
</div>
@endsection

<style>
    /* Style the badges */
    .badge-success {
        background-color: #28a745;
        color: white;
        padding: 6px 12px;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
        padding: 6px 12px;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
        padding: 6px 12px;
    }

    /* Style the service image */
    .service-image {
        max-width: 100%;
        max-height: 150px; /* Set your preferred maximum height */
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    /* Center the card text */
    .card-text {
        text-align: center;
    }
</style>
