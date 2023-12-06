@extends('layouts/layoutMaster')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

@section('title', 'Reservations List - Pages')

@section('vendor-style')
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<script src="/calendar.js"></script>
@section('vendor-script')
<script src="/assets/vendor/libs/moment/moment.js"></script>
<script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="/assets/vendor/libs/select2/select2.js"></script>
<script src="/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
<script src="/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
<script src="/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
<script src="/assets/vendor/libs/cleavejs/cleave.js"></script>
<script src="/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
@endsection
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<style>
    /* Add this CSS style to make all cards the same height */
    .custom-card {
        height: 100%;
    }
</style>
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card custom-card d-flex flex-column h-100">
            <div class="card-body d-flex flex-column justify-content-between flex-fill">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Total Reservations</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2" id="totalReservations">{{ $totalReservations }}</h3>
                        </div>

                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="far fa-calendar-alt fa-2x"></i> <!-- Use the "calendar" icon -->
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card custom-card d-flex flex-column h-100">
            <div class="card-body d-flex flex-column justify-content-between flex-fill">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Nombre de reservation en attente</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2" id="enAttenteCount">{{$enAttenteCount}}</h3>

                        </div>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-danger">
                            <i class="far fa-clock fa-2x"></i> <!-- Use the "clock" icon for pending -->
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card custom-card d-flex flex-column h-100">
            <div class="card-body d-flex flex-column justify-content-between flex-fill">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Nombre de reservation Confirmé</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2" id="confirmerCount">{{$confirmerCount}}</h3>
                        </div>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="far fa-check-circle fa-2x"></i> <!-- Use the "checkmark" icon for confirmed -->
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card custom-card d-flex flex-column h-100">
            <div class="card-body d-flex flex-column justify-content-between flex-fill">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Nombre de reservation refusé</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2" id="refuseCount">{{$refuseCount}}</h3>

                        </div>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="fas fa-exclamation-circle fa-2x"></i> <!-- Use the "exclamation" icon for refused -->
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Users List Table -->
<center>
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
    @endif
</center>
<center>
    @if (session('failed'))
    <div class="alert alert-danger" role="alert">
        {{session('failed')}}
    </div>
    @endif
</center>



<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Filtre de recherche</h5>
        <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <center>
                <div class="col-md-10 user_role">
                    <form id="date-filter-form" class="row align-items-center">
                        <div class="form-group col-md-6 col-sm-6 col-6">
                            <label for="start_date">Date de début:</label>
                            <input type="date" id="start_date" class="form-control">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-6">
                            <label for="end_date"> Date de fin:</label>
                            <input type="date" id="end_date" class="form-control">
                        </div>

                    </form>
                </div>
            </center>



        </div>
    </div>

    <script>
        $(document).ready(function() {
            var assetBaseUrl = '/storage/'; // Replace with your actual asset URL

            var acceptReservationRoute = "/accept-reservation";
            var refuserReservationRoute = "/Refuser-reservation";
            var markPaymentRoute = '/paye';
            $('#start_date, #end_date').on('input', function() {
                // Check if both start_date and end_date have values
                if ($('#start_date').val() !== '' && $('#end_date').val() !== '') {
                    // Trigger form submission
                    $('#date-filter-form').submit();
                }
            });

            $('#date-filter-form').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting traditionally

                // Get the selected start and end dates
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                if (startDate === '' || endDate === '') {
                    displayMessageErreur('Veuillez remplir les deux champs de date');
                    return;
                }
                // Check if the start date is after the end date
                var startDateObj = new Date(startDate);
                var endDateObj = new Date(endDate);

                if (startDateObj > endDateObj) {
                    displayMessageErreur('La date de début doit précéder la date de fin ');
                    return;
                }
                // Make an AJAX request to the server to fetch data
                $.ajax({
                    type: 'GET',
                    url: '/getReservationData', // Replace with the actual endpoint
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(data) {
                        // Update the page content with the data received from the server
                        // Display the data


                        var reservations = data.reservations;

                        var tableBody = $('.datatables-users tbody'); // Get the table body

                        // Clear the existing table rows
                        tableBody.empty();

                        for (var i = 0; i < reservations.length; i++) {
                            var reservation = reservations[i];

                            // Create a new table row
                            var row = $('<tr>');

                            // Create table cells for each column
                            var idCell = $('<td>').text(reservation.id);
                            var imageSrc = assetBaseUrl + (reservation.user.image ? reservation.user.image : '');

                            // Generate the 'nom' cell content
                            var nomCellContent = '<div class="d-flex justify-content-start align-items-center user-name">' +
                                '<div class="avatar me-3"><img src="' + (reservation.user.image ? '/storage/' + reservation.user.image : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(reservation.user.name) + '&background=104d93&color=fff') + '" alt="Avatar" class="rounded-circle"></div>' +
                                '<div class="d-flex flex-column"><a href="http://localhost:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">' + reservation.user.name + '</span></a><small class="text-muted">' + reservation.user.name + '</small></div>' +
                                '</div>';

                            var nomCell = $('<td>').html(nomCellContent);

                            // Generate the 'etat confirmation' cell content
                            var etatConfirmationCellContent;

                            if (reservation.etat_confirmation === 'confirmer') {
                                etatConfirmationCellContent = '<span class="badge bg-label-success" style="font-size: 16px;">Confirmé</span>';
                            } else if (reservation.etat_confirmation === 'refuser') {
                                etatConfirmationCellContent = '<span class="badge bg-label-danger" style="font-size: 16px;">Refusé</span>';
                            } else {
                                // Default behavior: Show the original value
                                etatConfirmationCellContent = '<span class="badge ' + badgeClass(reservation.etat_confirmation) + '" style="font-size: 16px;">' + reservation.etat_confirmation + '</span>';
                            }

                            var etatConfirmationCell = $('<td>').html(etatConfirmationCellContent);




                            var etatPaiementCellContent = '<span class="badge ' + badgeClassPayment(reservation.etat_paiement) + '" style="font-size: 16px;">' + reservation.etat_paiement + '</span>';
                            var etatPaiementCell = $('<td>').html(etatPaiementCellContent);

                            var typeReservationCell = $('<td>');

                            if (reservation.type_reservation === 'sur place') {
                                typeReservationCell.html('<i class="fas fa-map-marker-alt"></i> ' + reservation.type_reservation);
                            } else if (reservation.type_reservation === 'En ligne') {
                                typeReservationCell.html('<i class="fas fa-globe"></i> ' + reservation.type_reservation);
                            } else {
                                typeReservationCell.text(reservation.type_reservation);
                            }

                            // Generate the 'actions' cell content
                            var actionsCellContent = generateActionsHTML(reservation);
                            var actionsCell = $('<td>').html(actionsCellContent);

                            // Append the cells to the row in the desired order
                            row.append(idCell, nomCell, etatConfirmationCell, etatPaiementCell, typeReservationCell, actionsCell);

                            // Append the row to the table body
                            tableBody.append(row);
                        }

                        function badgeClassPayment(etatPaiement) {
                            if (etatPaiement === 'impayé') {
                                return 'bg-label-danger';
                            } else if (etatPaiement === 'payé') {
                                return 'bg-label-success';
                            } else {
                                // Handle other cases or set a default class if needed
                                return 'bg-label-default';
                            }
                        }
                        // Function to determine badge class based on etat_confirmation
                        function badgeClass(etatConfirmation) {
                            if (etatConfirmation === 'En attente') {
                                return 'bg-label-warning';
                            } else if (etatConfirmation === 'confirmer') {
                                return 'bg-label-success';
                            } else if (etatConfirmation === 'refuser') {
                                return 'bg-label-danger';
                            } else {
                                // Handle other cases or set a default class if needed
                                return 'bg-label-default';
                            }
                        }

                        // Function to generate the 'actions' HTML
                        function generateActionsHTML(reservation) {

                            var acceptButton = '';
                            var refuseButton = '';
                            var paymentButton = '';
                            if (reservation.etat_paiement === 'impayé') {
                                paymentButton = '<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal-' + reservation.id + '"><i class="fas fa-money-check"></i></button>';
                            }
                            if (reservation.etat_confirmation === 'En attente' || reservation.etat_confirmation === 'refuser') {
                                // Do not show paymentButton
                                paymentButton = '';
                            }
                            if (reservation.etat_confirmation === 'En attente') {
                                acceptButton = '<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptModal-' + reservation.id + '"><i class="fas fa-check"></i></button> ';
                                refuseButton = '<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#refuseModal-' + reservation.id + '"><i class="fas fa-times"></i></button>';
                            }

                            return acceptButton + refuseButton + paymentButton +
                                ' <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#calendarModal-' + reservation.id + '"><i class="fas fa-calendar-alt"></i></button>' +
                                '<div class="modal fade" id="acceptModal-' + reservation.id + '" tabindex="-1" aria-labelledby="acceptModalLabel-' + reservation.id + '" aria-hidden="true">' +
                                '<div class="modal-dialog" role="document">' +
                                '<div class="modal-content">' +
                                '<div class="modal-header">' +
                                '<h5 class="modal-title fs-5" id="acceptModalLabel-' + reservation.id + '">Confirmer l\'acceptation</h5>' +
                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                'Êtes-vous sûr de vouloir accepter cette réservation ID: ' + reservation.id + ' de  ' + reservation.user.name + ' ?' +
                                '</div>' +
                                '<div class="modal-footer">' +
                                '<form method="POST" action="' + acceptReservationRoute + '">' + // Use the variable
                                '{{ csrf_field() }}' + // Add the CSRF token as you do in your Blade views
                                '<input type="hidden" name="reservation_id" value="' + reservation.id + '">' +
                                '<input type="hidden" name="id_user" value="' + reservation.user.id + '">' +
                                '<button type="submit" class="btn btn-success"  style="margin-right: 10px;">Accepter</button>' +
                                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>' +
                                '</form>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="modal fade" id="calendarModal-' + reservation.id + '" tabindex="-1" aria-labelledby="calendarModalLabel-' + reservation.id + '" aria-hidden="true">' +
                                '<div class="modal-dialog modal-xl" role="document">' +
                                '<div class="modal-content">' +
                                '<div class="modal-header">' +
                                '<h5 class="modal-title fs-5" id="calendarModalLabel-' + reservation.id + '">Calendrier de réservation</h5>' +
                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                '<div id="calendar-' + reservation.id + '"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="modal fade" id="refuseModal-' + reservation.id + '" tabindex="-1" aria-labelledby="refuseModalLabel-' + reservation.id + '" aria-hidden="true">' +
                                '<div class="modal-dialog" role="document">' +
                                '<div class="modal-content">' +
                                '<div class="modal-header">' +
                                '<h5 class="modal-title fs-5" id="refuseModalLabel-' + reservation.id + '">Refuser la réservation</h5>' +
                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                'Êtes-vous sûr de vouloir refuser cette réservation ID: ' + reservation.id + ' de ' + reservation.user.name + ' ?' +
                                '</div>' +
                                '<div class="modal-footer">' +
                                '<form method="POST" action="' + refuserReservationRoute + '">' +
                                '{{ csrf_field() }}' + // Add the CSRF token as you do in your Blade views
                                '<input type="hidden" name="reservation_id" value="' + reservation.id + '">' +
                                '<input type="hidden" name="id_user" value="' + reservation.user.id + '">' +
                                '<button type="submit" class="btn btn-danger" style="margin-right: 10px;">Refuser</button>' +
                                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>' +
                                '</form>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="modal fade" id="paymentModal-' + reservation.id + '" tabindex="-1" aria-labelledby="paymentModalLabel-' + reservation.id + '" aria-hidden="true">' +
                                '<div class="modal-dialog" role="document">' +
                                '<div class="modal-content">' +
                                '<div class="modal-header">' +
                                '<h5 class="modal-title fs-5" id="paymentModalLabel-' + reservation.id + '">Mark Payment</h5>' +
                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                ' Êtes-vous sûr de vouloir marquer le paiement pour la réservation ID:' + reservation.id + ' de ' + reservation.user.name + ' ?' +
                                '</div>' +
                                '<div class="modal-footer">' +
                                '<form method="POST" action="' + markPaymentRoute + '">' + // Use the variable
                                '{{ csrf_field() }}' + // Add the CSRF token as you do in your Blade views
                                '<input type="hidden" name="reservation_id" value="' + reservation.id + '">' +
                                '<button type="submit" class="btn btn-success" style="margin-right: 10px;" >Marquer Payé</button>' +
                                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>' +
                                '</form>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';

                        }



                        $('#totalReservations').text(data.totalReservations);
                        $('#enAttenteCount').text(data.enAttenteCount);
                        $('#confirmerCount').text(data.confirmerCount);
                        $('#refuseCount').text(data.refuseCount);
                        displayMessage('Données filtrées avec succès');

                        // Display the date counts

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });

        function displayMessage(message) {
            toastr.success(message, 'Notifications');
        }

        function displayMessageErreur(message) {
            toastr.error(message, 'Notifications');
        }
    </script>
    <style>
        #toast-container>.toast-success {
            background-color: green !important;
            /* Use !important to override any inline styles */
        }

        #toast-container>.toast-error {
            background-color: red !important;
            /* Use !important to override any inline styles */
        }
    </style>
    <div class="card-datatable table-responsive">
        <div class="row me-2">
            <div class="col-md-2">

            </div>
            <div class="col-md-10">
                <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                    <div id="search" class="dataTables_filter"><label><input type="search" class="form-control" placeholder="Search.." aria-controls="DataTables_Table_0" id="search-input">
                        </label></div>
                    <div class="dt-buttons btn-group flex-wrap">
                        <div class="btn-group">
                            <button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-secondary mx-3" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="datatables-users table">
            <thead class="border-top">
                <tr>
                    <th>id</th>
                    <th>nom</th>
                    <th>etat confirmation</th>
                    <th>etat paiement</th>
                    <th>type reservation</th>
                    <th>Actions</th>
                </tr>
            </thead>

        </table>
    </div>

    <script>
        $(document).ready(function() {
            var table;

            // Initialize the DataTable
            table = $('.datatables-users').DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                info: true, // Add the info option

                ajax: {
                    url: '/getReservations',
                    data: function(d) {
                        d.search = $('#search-input').val();
                        d.pays = $('#UserRole').val();
                    }
                },
                columns: [{
                        data: 'id',
                        title: 'id'
                    },
                    {
                        data: 'nom',
                        title: 'nom'
                    },
                    {
                        data: 'etat confirmation',
                        title: 'etat confirmation'
                    },
                    {
                        data: 'etat paiement',
                        title: 'etat paiement'
                    },
                    {
                        data: 'type reservation',
                        title: 'type reservation'
                    },
                    {
                        data: 'actions',
                        title: 'Actions',
                    }
                ],
            });

            // Handle search input
            $('#search-input').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Handle 'pays' select input
            $('#UserRole').on('change', function() {
                table.ajax.reload();
            });

            // Handle clearing the search input
            $('#clear-search').on('keyup', function() {
                $('#search-input').val('');
                table.search('').draw();
            });

            // Error handling
            table.on('error.dt', function(e, settings, techNote, message) {
                // Handle errors here


                // Reload the page
                location.reload();
            });
        });
    </script>

    <style>
        /* Hide the search input */
        #DataTables_Table_0_filter {
            display: none;
        }
    </style>

    <!-- Offcanvas to add new user -->

</div>


<style>
    #calendar-1 {
        /* Replace XXX with your specific calendar ID */
        /* Your custom styles for this calendar go here */
        width: 100%;
        /* Set the width as needed */
        height: 100%;
        /* Set the height as needed */
        /* Add any other CSS rules you need */
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/und/popper.min.js"></script>





<div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5">Calendrier de réservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="calendar" style="width: 100%; height: 100%;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    function openCalendarModalWithReservationId(reservationId) {
        // Construct the modal selector using the reservationId
        const modalSelector = "#calendarModal";

        // Update the modal title with reservationId
        const modalTitle = $(modalSelector + ' .modal-title');
        modalTitle.text(`Calendrier de réservation ${reservationId}`);

        // Update the calendar div id
        const calendarDiv = $(modalSelector + ' #calendar');
        calendarDiv.attr('id', `calendar-${reservationId}`);

        // Trigger the modal to open
        $(modalSelector).modal('toggle');
    }

    function getReservationIdFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const reservationIdParam = urlParams.get("reservationId");

        if (reservationIdParam) {
            // Use the reservationId from the URL to open the corresponding calendar modal
            openCalendarModalWithReservationId(reservationIdParam);
            loadCalendarIntoModal(reservationIdParam);
            window.history.replaceState({}, document.title, window.location.pathname);

        }
    }

    // Call the function to check the URL and open the calendar modal
    getReservationIdFromURL();

    // Function to load the calendar into the modal
    function loadCalendarIntoModal(reservationId) {
        const calendarDivId = `calendar-${reservationId}`;

        // Retrieve the FullCalendar events for the reservation using an AJAX request
        $.ajax({
            url: `/get-panier-events/${reservationId}`, // Modify the URL to fetch panier data for the reservation
            method: 'GET',
            success: function(data) {
                // Initialize the FullCalendar within the modal
                const calendarEl = document.getElementById(calendarDivId);
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'fr',
                    slotLabelFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        omitZeroMinute: false,
                        hour12: false
                    },
                    slotMinTime: '08:00',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'listYear' // Use 'listYear' view to display all events for the entire year
                    },
                    initialView: 'listYear', // Set the initial view to 'listYear'
                    events: data, // Use the retrieved panier data as events
                    views: {
                        timeGrid: {
                            dayHeaderFormat: {
                                weekday: 'short',
                                month: 'numeric',
                                day: 'numeric',
                                omitCommas: true
                            },
                            dayMaxEventRows: 3, // Adjust the number of events displayed in each cell
                        },
                        dayGrid: {
                            dayHeaderFormat: {
                                weekday: 'short',
                                month: 'numeric',
                                day: 'numeric',
                                omitCommas: true
                            },
                        },
                    },
                    windowResize: function() {
                        // Adjust the number of columns based on the window size
                        if (window.innerWidth < 576) {
                            calendar.changeView('timeGridDay');
                        } else {
                            calendar.changeView('timeGridWeek');
                        }
                    },
                    eventClick: function(arg) {
                        // Handle event click to navigate to the day
                        calendar.gotoDate(arg.event.start);
                        calendar.changeView('timeGridDay');
                    },
                });


                calendar.render();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // Call the function to load the calendar modal when the page loads with a specific reservation ID
    // You can specify the reservation ID you want to load here.
    // For example: 
    // loadCalendarIntoModal(27);
</script>






@endsection