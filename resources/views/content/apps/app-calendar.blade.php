@extends('layouts/layoutMaster')

@section('title', 'Fullcalendar - Apps')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('vendor-style')
<link rel="stylesheet" href="/assets/vendor/libs/fullcalendar/fullcalendar.css" />
<link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css" />
<link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="/assets/vendor/libs/quill/editor.css" />
<link rel="stylesheet" href="/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />
@endsection

@section('page-style')
<link rel="stylesheet" href="/assets/vendor/css/pages/app-calendar.css" />
@endsection

@section('vendor-script')
<script src="/assets/vendor/libs/fullcalendar/fullcalendar.js"></script>
<script src="/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
<script src="/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
<script src="/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
<script src="/assets/vendor/libs/select2/select2.js"></script>
<script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
<script src="/assets/vendor/libs/moment/moment.js"></script>
@endsection

@section('page-script')
<script src="/assets/js/app-calendar-events.js"></script>
<script src="/assets/js/app-calendar.js"></script>
@endsection

@section('content')
<div class="card app-calendar-wrapper">
  <div class="row g-0">
    <!-- Calendar Sidebar -->

    <!-- /Calendar Sidebar -->

    <!-- Calendar & Modal -->
    <div class="col app-calendar-content">
      <div class="card shadow-none border-0">
        <div class="card-body pb-0">
          <!-- FullCalendar -->
          <div id="calendar"></div>
        </div>
      </div>
      <div class="app-overlay"></div>
      <!-- FullCalendar Offcanvas -->

    </div>
    <!-- /Calendar & Modal -->
  </div>
</div>
@endsection


<script>
  document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'fr', // Set the locale to French

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
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      buttonText: {
        today: 'Aujourd\'hui', // Customize the "today" button
        month: 'Mois', // Customize the "month" button
        week: 'Semaine', // Customize the "week" button
        day: 'Jour', // Customize the "day" button
      },
      events: function(fetchInfo, successCallback, failureCallback) {

        var startOfMonth = fetchInfo.start.toISOString().substring(0, 7) + '-01';
        var endOfMonth = fetchInfo.end.toISOString().substring(0, 7) + '-01';

        $.ajax({
          url: `/services-in-panier-month/${startOfMonth}/${endOfMonth}`,
          type: 'GET',
          success: function(data) {
            var events = data.dates
              .filter(function(date) {
                return date.count > 0;
              })
              .map(function(date) {
                return {
                  title: `${date.count}`,
                  start: date.date,
                  allDay: false,
                  className: 'count-event',
                };
              });

            // Fetch events from the `getPanierEvents` method
            $.ajax({
              url: '/get-panier-events',
              type: 'GET',
              success: function(panierEvents) {
                panierEvents.forEach(function(event) {
                  events.push({
                    title: event.title,
                    start: event.start,
                    end: event.end,
                    backgroundColor: getRandomColor(),
                    extendedProps: {
                      reservation_id: event.reservation_id,
                      etat_confirmation: event.etat_confirmation,
                      id_user: event.id_user // Include the reservation_id in extendedProps
                    } // Assign a random background color
                  });
                });

                successCallback(events);
              },
              error: function(error) {
                console.log(error);
              }
            });
          },
          error: function(error) {
            console.log(error);
          }
        });
      },
      dayMaxEvents: true,
      // eventClick: function(arg) {
      //   // Check if the current view is 'timeGridDay'
      //   if (arg.view.type === 'timeGridDay') {
      //     var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      //     // Get the reservation ID and status from the clicked event
      //     var reservationId = arg.event.extendedProps.reservation_id;
      //     var status = arg.event.extendedProps.etat_confirmation;
      //     var id_user = arg.event.extendedProps.id_user;

      //     // Check if the status is "En attente"
      //     // Check if the status is "En attente"
      //     if (status === 'En attente') {
      //       // Perform your custom logic here
      //       // For example, make an API call to accept the reservation
      //       fetch('/accept-reservation', {
      //           method: 'POST',
      //           headers: {
      //             'Content-Type': 'application/json',
      //             'X-CSRF-TOKEN': csrfToken,
      //           },
      //           body: JSON.stringify({
      //             reservation_id: reservationId,
      //             id_user: id_user
      //           }),
      //         })
      //         .then(response => response.json())
      //         .then(data => {
      //           console.log(data.message);

      //           // Show a success toast message
      //           displayMessage(data.message);

      //           // Refetch events to refresh the calendar
      //           calendar.refetchEvents();

      //           // You can update the event as needed
      //           arg.event.setProp('title', 'confirmer'); // Update the event title

      //           // If you want to display service details in the admin's console
      //           if (arg.event.extendedProps.service_details) {
      //             console.log('Services Choisis : ' + arg.event.extendedProps.service_details);
      //           }
      //         })
      //         .catch(error => {
      //           console.error('Error:', error);

      //           // Show an error toast message
      //           displayMessageErreur('An error occurred while accepting the reservation.');
      //         });
      //     } else {
      //       // Show a message indicating the reservation is not in the "En attente" status
      //       displayMessageErreur("Cette réservation n'est pas en statut 'En attente'.");
      //     }

      //   }
      // },

      eventContent: function(arg) {

        if (arg.view.type === 'dayGridMonth') {
          // Check for the custom class 'count-event' to apply special styling
          if (arg.event.classNames.includes('count-event')) {
            return {
              html: '<div style="font-size: 20px; padding-left: 44px; color: blue;">' + arg.event.title + '</div>'
            };
          } else {
            // For other events in 'dayGridMonth', return an empty string to hide the title
            return {

            };
          }
        } else {
          // In other views, show the event content but hide the title
          return {
            html: '<div class="event-title" style="background-color: ' + arg.event.backgroundColor + ';">' + arg.event.title + '</div>'
          };
        }
      },

      dateClick: function(arg) {
        calendar.gotoDate(arg.date);
        calendar.changeView('timeGridDay');
      }
    });

    calendar.render();
  });

  // Function to generate a random background color
  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  function displayMessage(message) {
    toastr.success(message, 'Réservation');
  }

  function displayMessageErreur(message) {
    toastr.error(message, 'Réservation');
  }
</script>


<script src="/assets/fullcalendar/dist/index.global.js"></script>
<style>
  /* Add this CSS to your stylesheets */
  .event-title {
    /* Style the individual event titles within the group */
    font-size: 13px;
    padding: 2px 6px;
    /* Adjust padding as needed */
    color: white;
    max-width: 70%;
    /* Increase the max-width value */
    white-space: normal;
    /* Allow text to wrap to the next line if needed */
    overflow: hidden;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 4px;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
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