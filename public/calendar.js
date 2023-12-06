$(function () {
    // Attach a click event to the calendar modals
    $(document).on('click', '[data-bs-toggle="modal"][data-bs-target^="#calendarModal-"]', function () {
        const reservationId = $(this).data('bs-target').substring('#calendarModal-'.length);
        const calendarDivId = `calendar-${reservationId}`;

        // Retrieve the FullCalendar events for the reservation using an AJAX request
        $.ajax({
            url: `/get-panier-events/${reservationId}`, // Modify the URL to fetch panier data for the reservation
            method: 'GET',
            success: function (data) {
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
                            dayHeaderFormat: { weekday: 'short', month: 'numeric', day: 'numeric', omitCommas: true },
                            dayMaxEventRows: 3, // Adjust the number of events displayed in each cell
                        },
                        dayGrid: {
                            dayHeaderFormat: { weekday: 'short', month: 'numeric', day: 'numeric', omitCommas: true },
                        },
                    },
                    windowResize: function () {
                        // Adjust the number of columns based on the window size
                        if (window.innerWidth < 576) {
                            calendar.changeView('timeGridDay');
                        } else {
                            calendar.changeView('timeGridWeek');
                        }
                    },
                    eventClick: function (arg) {
                        // Handle event click to navigate to the day
                        calendar.gotoDate(arg.event.start);
                        calendar.changeView('timeGridDay');
                    },
                });
                // Show the modal
                $('#calendarModal-' + reservationId).modal('show');

                // Function to handle calendar resizing
                const resizeCalendar = function () {
                    calendar.updateSize();
                };

                // Attach the resize function to the modal show event
                $('#calendarModal-' + reservationId).on('shown.bs.modal', resizeCalendar);

                // Handle window resize events
                $(window).on('resize', resizeCalendar);
                calendar.render();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
