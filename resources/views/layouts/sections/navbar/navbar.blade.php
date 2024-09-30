@php
$containerNav = (isset($configData['contentLayout']) && $configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/timeago.js/4.0.2/timeago.min.js"></script>


<!-- <script>
  @if($errors -> has('old_password') || $errors -> has('new_password') || $errors -> has('confirm_password'))
  $(document).ready(function() {
    // Show the password modal if there are validation errors
    $('.passwordModal').modal('show');
  });
  @endif
</script> -->
<script>
  $(document).ready(function() {
    // Check if the session variable 'azer' is set
    @if(session('passwordChangeSuccess'))
    // Show the success modal
    $('#passwordChangeSuccessModal').modal('show');
    @endif




  });
</script>
<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="/" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            @include('_partials.macros',["height"=>20])
          </span>
          <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="ti ti-menu-2 ti-sm"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        @if(!isset($menuHorizontal))
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item navbar-search-wrapper mb-0">
            <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
              <i class="ti ti-search ti-md me-2"></i>
              <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
            </a>
          </div>
        </div>
        <!-- /Search -->
        @endif
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- Language -->
        
          <!--/ Language -->

          @if(isset($menuHorizontal))
          <!-- Search -->
          <li class="nav-item navbar-search-wrapper me-2 me-xl-0">
            <a class="nav-link search-toggler" href="javascript:void(0);">
              <i class="ti ti-search ti-md"></i>
            </a>
          </li>
          <!-- /Search -->
          @endif
          @if($configData['hasCustomizer'] == true)
          <!-- Style Switcher -->
          <li class="navbar-nav align-items-center">
            <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <i class='ti ti-md'></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-start dropdown-styles">
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                    <span class="align-middle"><i class='ti ti-sun me-2'></i>Light</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                    <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                    <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <!--/ Style Switcher -->
          @endif

          <!-- Quick links  -->
          <!-- <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <i class='ti ti-layout-grid-add ti-md'></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end py-0">
              <div class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                  <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i class="ti ti-sm ti-apps"></i></a>
                </div>
              </div>
              <div class="dropdown-shortcuts-list scrollable-container">
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-calendar fs-4"></i>
                    </span>
                    <a href="{{url('app/calendar')}}" class="stretched-link">Calendar</a>
                    <small class="text-muted mb-0">Appointments</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-file-invoice fs-4"></i>
                    </span>
                    <a href="{{url('app/invoice/list')}}" class="stretched-link">Invoice App</a>
                    <small class="text-muted mb-0">Manage Accounts</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-users fs-4"></i>
                    </span>
                    <a href="{{url('app/user/list')}}" class="stretched-link">User App</a>
                    <small class="text-muted mb-0">Manage Users</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-lock fs-4"></i>
                    </span>
                    <a href="{{url('app/access-roles')}}" class="stretched-link">Role Management</a>
                    <small class="text-muted mb-0">Permission</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-chart-bar fs-4"></i>
                    </span>
                    <a href="{{url('/')}}" class="stretched-link">Dashboard</a>
                    <small class="text-muted mb-0">User Profile</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-settings fs-4"></i>
                    </span>
                    <a href="{{url('pages/account-settings-account')}}" class="stretched-link">Setting</a>
                    <small class="text-muted mb-0">Account Settings</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-help fs-4"></i>
                    </span>
                    <a href="{{url('pages/faq')}}" class="stretched-link">FAQs</a>
                    <small class="text-muted mb-0">FAQs & Articles</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-square fs-4"></i>
                    </span>
                    <a href="{{url('modal-examples')}}" class="stretched-link">Modals</a>
                    <small class="text-muted mb-0">Useful Popups</small>
                  </div>
                </div>
              </div>
            </div>
          </li> -->
          <!-- Quick links -->
          <style>
            #no-notifications-message {
              display: none;
              font-weight: bold;
              color: #999;
            }
          </style>
          <!-- Notification -->
          <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <i class="ti ti-bell ti-md"></i>
              <span class="badge bg-danger rounded-pill badge-notifications">0</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end py-0">
              <li class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Notification</h5>
                  <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
                </div>
              </li>
              <li class="dropdown-notifications-list scrollable-container">
                <ul class="list-group list-group-flush" id="notifications-list">
                  <center>
                  <div id="no-notifications-message" style="font-size: 18px; padding: 10px;">Aucune notification à afficher.</div>
                  </center>
                </ul>
              </li>

            </ul>
          </li>


          <!--/ Notification -->

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="/admin.png" alt class="h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : url('pages/profile-user') }}">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="/admin.png" alt class="h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-medium d-block">
                        @if (Auth::check())
                        {{ Auth::user()->name }}
                        @else
                        John Doe
                        @endif
                      </span>
                      <small class="text-muted">Admin</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>

                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#passwordModal">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="align-middle">changer mot de passe</span>
                </a>

              <li>
                <div class="dropdown-divider"></div>
              </li>
              @if (Auth::check())
              <li>
                <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class='ti ti-logout me-2'></i>
                  <span class="align-middle">Se déconnecter</span>
                </a>
              </li>
              <form method="POST" id="logout-form" action="/logout">
                @csrf
              </form>
              @else
              <li>
                <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : url('auth/login-basic') }}">
                  <i class='ti ti-login me-2'></i>
                  <span class="align-middle">Login</span>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      <!-- Search Small Screens -->
      <div class="navbar-search-wrapper search-input-wrapper {{ isset($menuHorizontal) ? $containerNav : '' }} d-none">
        <input type="text" class="form-control search-input {{ isset($menuHorizontal) ? '' : $containerNav }} border-0" placeholder="Search..." aria-label="Search...">
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
      </div>
      @if(isset($navbarDetached) && $navbarDetached == '')
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
  <script src="/js/app.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Include this CSS for styling notifications -->
  <style>
    .dropdown-notifications-item {
      padding: 10px;
      border-bottom: 1px solid #f0f0f0;
    }

    .avatar img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    .dropdown-notifications-actions a {
      margin: 0 5px;
    }
  </style>

  <!-- Your HTML structure remains the same -->


  <!-- Include jQuery -->

<style>
  /* Add this to your stylesheet */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
    z-index: 9999; /* Ensure the overlay appears on top of other elements */
    align-items: center;
    justify-content: center;
}

.lds-ripple {
    display: inline-block;
    position: relative;
    width: 64px;
    height: 64px;
}

.lds-ripple div {
    position: absolute;
    border: 33px solid #3498db; /* Change the color to your preference */
    opacity: 1;
    border-radius: 50%;
    animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}

@keyframes lds-ripple {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
        opacity: 0;
    }
}


  </style>
<div id="overlay" class="overlay">
    <div id="your-spinner-id" class="lds-ripple">
        <div></div>
        <div></div>
    </div>
    
</div>  
<script>
function showSpinner() {
    // Show the overlay with the spinner
    document.getElementById('overlay').style.display = 'flex';
    
}

function hideSpinner() {
    // Hide the overlay
    document.getElementById('overlay').style.display = 'none';
}


    document.addEventListener("DOMContentLoaded", function() {
      function formatRelativeTime(date) {
      const now = new Date();
      const diffInSeconds = Math.floor((now - date) / 1000);

      const rtf = new Intl.RelativeTimeFormat('en', { numeric: 'auto' });

      if (diffInSeconds < 60) {
        return rtf.format(-diffInSeconds, 'second');
      } else if (diffInSeconds < 3600) {
        const diffInMinutes = Math.floor(diffInSeconds / 60);
        return rtf.format(-diffInMinutes, 'minute');
      } else if (diffInSeconds < 86400) {
        const diffInHours = Math.floor(diffInSeconds / 3600);
        return rtf.format(-diffInHours, 'hour');
      } else {
        const diffInDays = Math.floor(diffInSeconds / 86400);
        return rtf.format(-diffInDays, 'day');
      }
    }
    function updateRelativeTime() {
      const timeAgoElements = document.querySelectorAll('.time-ago');
      timeAgoElements.forEach(element => {
        const timestamp = element.getAttribute('data-timestamp');
        const date = new Date(timestamp);
        const relativeTime = formatRelativeTime(date);
        element.innerText = relativeTime;
      });
    }  
    setInterval(updateRelativeTime, 5000);

      // Initialize the notification count
      let notificationCount = 0;

      // Function to update the badge count in the UI
      function updateBadgeCount() {
        badgeCount.innerText = notificationCount;
      }
      fetch('/fetch-notifications')
        .then(response => response.json())
        .then(data => {
          const notifications = data.notifications;
          const unreadCount = data.unreadCount; // Get the unread notification count
          
          notificationCount = unreadCount;
          updateBadgeCount();

          notifications.forEach(notification => {
            try {
              const created_at = notification.created_at;
              const relativeTimefetch = formatRelativeTime(new Date(created_at));

              const dataToBroadcast = JSON.parse(notification.data_to_broadcast);
              const reservation = dataToBroadcast.reservation;

              if (reservation) {
                // Create a reservation details element
                const userImage = reservation.user.image ?
                  `<div class="avatar me-3"><img src="/storage/${reservation.user.image}" alt="${reservation.user.name}" class="h-auto rounded-circle"></div>` :
                  `<div class="avatar me-3"><img src="https://ui-avatars.com/api/?name=${encodeURIComponent(reservation.user.name)}&background=104d93&color=fff" alt="Avatar" class="rounded-circle"></div>`;

                const reservationContainer = document.createElement('li');
                reservationContainer.className = 'list-group-item list-group-item-action dropdown-notifications-item';
                reservationContainer.innerHTML = `
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar">
                  ${userImage}
                </div>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1">${reservation.user.name} a fait une réservation</h6>
                <p class="mb-0" style="font-size: 12px;">
                  Réservation ID: ${reservation.id}<br>
                  État de confirmation: ${reservation.etat_confirmation}<br>
                  État de paiement: ${reservation.etat_paiement}<br>
                  Type de réservation: ${reservation.type_reservation}
                  <a href="#" style="text-decoration: underline;" class="voir-details-button" data-reservation-id="${reservation.id}">Voir les détails</a>
                  
                </p>
                <span class="time-ago" data-timestamp="${created_at}">${relativeTimefetch}</span>

              </div>
              <div class="delete-button-container">
      <button class="delete-notification-button" data-notification-id="${notification.id}">&#10006;</button>
    </div>
            </div>
          `;

                // Get the existing notifications list element
                const notificationsList = document.getElementById('notifications-list');

                // Add the reservation details element to the notification list
                notificationsList.insertBefore(reservationContainer, notificationsList.firstChild);
               const deleteButton = reservationContainer.querySelector('.delete-notification-button');
                                deleteButton.addEventListener('click', function (event) {
                                    event.preventDefault();
                                    showSpinner();
                                    const notificationId = deleteButton.getAttribute('data-notification-id');
                                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                    // Implement an API request to delete the notification
                                    fetch(`/delete-notificationAdmin/${notificationId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                                            'Content-Type': 'application/json',
                                        },
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            // Handle success (update UI, show toast, etc.)
                                            displayMessage('Notification supprimée avec succès.');
                                            reservationContainer.remove(); // Remove the notification from the UI

                                            // Ensure the count doesn't go below zero
                                            notificationCount = Math.max(notificationCount - 1, 0);

                                            updateBadgeCount();
                                            if (notificationCount === 0) {
                        noNotificationsMessage.style.display = 'block';
                    } else {
                        noNotificationsMessage.style.display = 'none';
                    }
                    
                                        })
                                        .catch(error => {
                                            // Handle error
                                            console.error('Error deleting notification:', error);
                                            displayMessageErreur('Erreur lors de la suppression de la notification.');
                                        })
                                        .finally(() => {
        // Hide the spinner when the operation is complete, regardless of success or failure
        hideSpinner();

    });
                                });
                            }
                        } catch (error) {
                            console.error('Error parsing notification data:', error);
                        }
                    });
                    if (notificationCount === 0) {
                        noNotificationsMessage.style.display = 'block';
                    } else {
                        noNotificationsMessage.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching notifications:', error);
                });

      // ...

      // Listen for new notifications from the WebSocket
      const echo = window.Echo.channel('AdminChannel');
      const badgeCount = document.querySelector('.badge-notifications');
      const noNotificationsMessage = document.getElementById('no-notifications-message');
      const notificationsList = document.getElementById('notifications-list');

      // ...

      echo.listen('.App\\Events\\AdminChannel', (e) => {
        const data = e.message;

        // Extract reservation from the received data
        const {
          reservation,
          notification_id ,
          created_at

        } = data;
        const relativeTime = formatRelativeTime(new Date(created_at));

        // Create a reservation details element
        const userImage = reservation.user.image ?
          `<div class="avatar me-3"><img src="/storage/${reservation.user.image}" alt="${reservation.user.name}" class="h-auto rounded-circle"></div>` :
          `<div class="avatar me-3"><img src="https://ui-avatars.com/api/?name=${encodeURIComponent(reservation.user.name)}&background=104d93&color=fff" alt="Avatar" class="rounded-circle"></div>`;

        const reservationContainer = document.createElement('li');
        reservationContainer.className = 'list-group-item list-group-item-action dropdown-notifications-item';
        reservationContainer.innerHTML = `
      <div class="d-flex">
        <div class="flex-shrink-0 me-3">
          <div class="avatar">
          ${userImage}
            </div>
        </div>
        <div class="flex-grow-1">
          <h6 class="mb-1">${reservation.user.name} a fait une réservation</h6>
          <p class="mb-0" style="font-size: 12px;">
            Réservation ID: ${reservation.id}<br>
            État de confirmation: ${reservation.etat_confirmation}<br>
            État de paiement: ${reservation.etat_paiement}<br>
            Type de réservation: ${reservation.type_reservation}
            <a href="#" style="text-decoration: underline;" class="voir-details-button" data-reservation-id="${reservation.id}">Voir les détails</a>

            </p>
            <span class="time-ago" data-timestamp="${created_at}">${relativeTime}</span>

        </div>
        <div class="delete-button-container">
      <button class="delete-notification-button" data-notification-id="${notification_id}">&#10006;</button>
    </div> 
      </div>
    `;

        // Add the reservation details element to the notification list
        notificationsList.insertBefore(reservationContainer, notificationsList.firstChild);
    // Add a click event listener to the delete button
    const deleteButton = reservationContainer.querySelector('.delete-notification-button');
                                deleteButton.addEventListener('click', function (event) {
                                    event.preventDefault();
                                    showSpinner();

                                    const notificationId = deleteButton.getAttribute('data-notification-id');
                                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                    // Implement an API request to delete the notification
                                    fetch(`/delete-notificationAdmin/${notificationId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                                            'Content-Type': 'application/json',
                                        },
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            // Handle success (update UI, show toast, etc.)
                                            displayMessage('Notification supprimée avec succès.');
                                            reservationContainer.remove(); // Remove the notification from the UI

                                            // Ensure the count doesn't go below zero
                                            notificationCount = Math.max(notificationCount - 1, 0);

                                            updateBadgeCount();
                                            if (notificationCount === 0) {
                        noNotificationsMessage.style.display = 'block';
                    } else {
                        noNotificationsMessage.style.display = 'none';
                    }
                                        })
                                        .catch(error => {
                                            // Handle error
                                            console.error('Error deleting notification:', error);
                                            displayMessageErreur('Erreur lors de la suppression de la notification.');
                                        })
                                        .finally(() => {
        // Hide the spinner when the operation is complete, regardless of success or failure
        hideSpinner();

    });
                                });
        // Update the notification count by adding one for the new reservation
        notificationCount += 1;
        updateBadgeCount();

        if (notificationCount === 0) {
          noNotificationsMessage.style.display = 'block';
        } else {
          noNotificationsMessage.style.display = 'none';
        }
      });

      // ...

      // Add a click event listener to the "Mark all as read" link


      // Add a click event listener to the "Mark all as read" link
      const markAsReadLink = document.querySelector('.dropdown-notifications-all');
      markAsReadLink.addEventListener('click', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Implement an API request to mark all notifications as read
        fetch('/mark-notifications-as-read', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
              'Content-Type': 'application/json',
            },
          })
          .then(response => response.json())
          .then(data => {
            // Reset the notification count
            notificationCount = 0;
            updateBadgeCount();

            // Update the UI to mark all notifications as read
            const notificationItems = document.querySelectorAll('.dropdown-notifications-item');
            notificationItems.forEach(item => {
              // Update the UI to mark the notification as read (you can add a CSS class or other visual indication)
              item.classList.add('read'); // Apply a CSS class for styling, e.g., add 'read' class
            });
          })
          .catch(error => {
            console.error('Error marking notifications as read:', error);
          });
      });


      document.addEventListener('click', function(event) {
        if (event.target.classList.contains('voir-details-button')) {
          const reservationId = event.target.getAttribute('data-reservation-id');

          // Navigate to the reservation page and open the calendar for the reservation
          window.location.href = `http://127.0.0.1:8000/app/Reservation/liste?reservationId=${reservationId}`;
        }
      });

    });
    function displayMessage(message) {
    toastr.options = {
        closeButton: true, // Show the close button
        positionClass: 'toast-top-center', // Display the toast at the top and center
    };
    toastr.success(message, 'notification');
}

function displayMessageErreur(message) {
    toastr.options = {
        closeButton: true, // Show the close button
        positionClass: 'toast-top-center', // Display the toast at the top and center
    };
    toastr.error(message, 'notification');
}
  </script>
  <style>
    /* Add this CSS to your existing stylesheet or in a <style> tag in your HTML file */

    .list-group-item {
      position: relative;
    }

    .delete-button-container {
      position: absolute;
      top: 0;
      right: 0;
    }

    .delete-notification-button {
      background: none;
      border: none;
      font-size: 12px;
      cursor: pointer;
      color: #ff0000;
      /* Choose your desired color */
    }

    /* Add this CSS to your stylesheet */

    /* Style for the reservation container */
    .reservation-container {
      background-color: #007bff;
      /* Background color */
      color: #fff;
      /* Text color */
      padding: 20px;
      /* Padding for the container */
      border-radius: 10px;
      /* Rounded corners */
      margin-bottom: 20px;
      /* Spacing between items */
    }

    /* Style for the reservation title */
    .reservation-title {
      font-size: 24px;
      /* Larger font size for the title */
      font-weight: bold;
      /* Make it bold */
      margin-bottom: 10px;
      /* Spacing between title and details */
    }

    /* Style for the reservation details */
    .reservation-details {
      font-size: 18px;
      /* Font size for the details */
      margin-bottom: 10px;
      /* Spacing between details and notifications */
    }

    /* Style for the notification container */
    .notification-container {
      background-color: #f9f9f9;
      /* Background color for notifications */
      color: #333;
      /* Text color */
      padding: 10px;
      /* Padding for notifications */
      border: 1px solid #ccc;
      /* Add a border */
      border-radius: 4px;
      /* Rounded corners */
      margin-bottom: 10px;
      /* Spacing between notifications */
    }

    /* Style for individual notification items */
    .notification-item {
      margin-bottom: 10px;
      /* Spacing between items */
    }

    /* Style for the notification text */
    .notification-text {
      font-size: 16px;
      /* Font size for notification text */
    }
  </style>
  <div class="modal fade passwordModal" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="/update_password">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="passwordModalLabel">Changer le mot de passe</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Old Password -->
            <div class="mb-3">
              <label for="old_password" class="form-label">Ancien mot de passe</label>
              <input type="password" class="form-control" id="old_password" value="{{ old('old_password') }}" name="old_password" required>
              @if ($errors->has('old_password'))
              <div class="alert alert-danger">{{ $errors->first('old_password') }}</div>
              @endif
            </div>

            <!-- New Password -->
            <div class="mb-3">
              <label for="new_password" class="form-label">Nouveau mot de passe</label>
              <input type="password" class="form-control" id="new_password" value="{{ old('new_password') }}" name="new_password" required>
              @error('new_password')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirmer le nouveau mot de passe</label>
              <input type="password" class="form-control" id="confirm_password" value="{{ old('confirm_password') }}" name="confirm_password" required>
              @error('confirm_password')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
          </div>
        </form>
      </div>
    </div>
  </div>