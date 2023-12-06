<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col">

            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        @if($user->image)
                        <!-- User has an image, display it using asset -->
                        <img src="/storage/{{ $user->image}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        @else
                        <!-- User doesn't have an image, show default avatar from ui-avatars.com -->
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=104d93&color=fff" height="150px" width="150px" alt="Default Avatar" class="rounded-circle img-fluid">
                        @endif
                        <h5 class="my-3">{{ $user->name }}</h5>
                        @if(isset($reservation->id))
                        <div class="reservation-id-container">
                            <p class="text-muted mb-2">Reservation ID</p>
                            <p class="reservation-id">{{ $reservation->id }}</p>
                        </div>
                        @endif
                        <div class="d-flex justify-content-center mb-2">
                            <div class="payment-status-container">
                                <p class="text-muted mb-2">Statut de paiement</p>
                                <div class="payment-status">
                                    @if($reservation->etat_paiement === 'impayé')
                                    <span class="badge bg-warning text-dark" style="font-size: large;"><i class="fas fa-exclamation-circle"></i> Impayé</span>
                                    @elseif($reservation->etat_paiement === 'payé')
                                    <span class="badge bg-success" style="font-size: large;"><i class="fas fa-check-circle"></i> Payé</span>
                                    @else
                                    <span class="badge bg-secondary">Inconnu</span>
                                    @endif
                                </div>
                                <p class="text-muted mt-2">Type de réservation</p>
                                <div class="reservation-type">
                                    @if($reservation->type_reservation === 'sur place')
                                    <span class="badge bg-info" style="font-size: large;"><i class="fas fa-store"></i> Sur Place</span>
                                    @elseif($reservation->type_reservation === 'En ligne')
                                    <span class="badge bg-primary" style="font-size: large;"><i class="fas fa-globe"></i> En Ligne</span>
                                    @else
                                    <span class="badge bg-secondary">Inconnu</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <style>
                .reservation-id-container {
                    background-color: #f8f9fa;
                    /* Light gray background */
                    border: 1px solid #dee2e6;
                    /* Border color */
                    padding: 10px;
                    text-align: center;
                    border-radius: 5px;
                    /* Optional: Rounded corners */
                    margin-bottom: 20px;
                    /* Optional: Add some spacing */
                }

                .reservation-id {
                    font-size: 18px;
                    font-weight: bold;
                    color: #007bff;
                    /* Blue color, you can change this */
                }
            </style>

            </style>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nom et prénom</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->name }}</p>
                            </div>


                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Téléphone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->numero }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">genre</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->genre }}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">pays</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->pays }}</p>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- Existing HTML and CSS... -->

                <!-- Existing HTML and CSS... -->

                <!-- Existing HTML and CSS... -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- User details... -->

                                @if(count($selectedItems) > 0)
                                <hr>
                                <h5>Vos  Servcie(s)</h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Service</th>
                                                <th>Image</th>
                                                <th>Nombre de places</th>
                                                <th>Prix</th>
                                                <th>Debut</th>
                                                <th>Fin</th>
                                                <th>Sous-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($selectedItems as $item)
                                            <tr>
                                                <td>{{ $item['service_name'] }}</td>
                                                <td><img src="{{ $item['image'] }}" alt="{{ $item['service_name'] }}" style="max-width: 100px;"></td>
                                                <td>{{ $item['nombre_de_place'] }}</td>
                                                <td>{{ $item['prix'] }}</td>
                                                <td>{{ $item['start'] }}</td>
                                                <td>{{ $item['end'] }}</td>
                                                <td>{{ $item['subtotal'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <p>No items selected.</p>
                                @endif

                                <!-- Additional user details... -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional HTML and CSS... -->


                <!-- Additional HTML and CSS... -->


                <!-- Additional HTML and CSS... -->

            </div>
        </div>
    </div>
</section>