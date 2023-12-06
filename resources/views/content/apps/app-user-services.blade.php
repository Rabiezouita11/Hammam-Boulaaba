@extends('layouts/layoutMaster')

@section('title', 'Services List - Pages')

@section('vendor-style')
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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

<script>
  // Check if validation errors exist and show the modal if they do

  // @if($errors -> has('name'))
  // $(document).ready(function() {
  //   // Show the password modal if there are validation errors
  //   $('.offcanvasAddUser').modal('show');
  // });
  // @endif
</script>

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


<style>
  /* Add this CSS style to make all cards the same height */
  .custom-card {
    height: 85%;
  }
</style>

<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card custom-card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Total Services</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">{{ $ServicesCount}}</h3>
            </div>

          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="fas fa-list-alt fa-2x"></i> <!-- Font Awesome list-alt icon for Totale Services -->
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card custom-card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Service de durée maximale</span>
            <h3 class="mb-0 me-2">{{ $maxDurationService->dure }} hours</h3>
            <p>{{ $maxDurationService->Designations }}</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="fas fa-clock  fa-2x"></i> <!-- Font Awesome clock icon -->

            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card custom-card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Service à prix maximum</span>
            <h3 class="mb-0 me-2">{{ $maxPriceService->prix }} TND</h3>
            <p>{{ $maxPriceService->Designations }}</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-danger">
              <i class="fas fa-money-bill-alt  fa-2x"></i> <!-- Font Awesome money icon -->
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card custom-card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Service de capacité maximale</span>
            <h3 class="mb-0 me-2">{{ $maxCapacityService->capacite }}</h3>
            <p>{{ $maxCapacityService->Designations }}</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-success">
              <i class="fas fa-users fa-2x"></i> <!-- Font Awesome users icon for Service de capacité maximale -->
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- Services List Table -->
<center>
  @if (session('success'))
  <div class="alert alert-success" role="alert">
    {{session('success')}}
  </div>
  @endif
</center>
<center>
  @if (session('error'))
  <div class="alert alert-danger" role="alert">
    {{session('error')}}
  </div>
  @endif
</center>

<div class="card">
  <div class="card-header border-bottom">
    <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
      <div class="col-md-4 user_role">


      </div>


    </div>
  </div>


  <div class="card-datatable table-responsive">
    <div class="row me-2">
      <div class="col-md-2">

      </div>
      <div class="col-md-10">
        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
          <div id="search" class="dataTables_filter"><label><input type="search" class="form-control" placeholder="Search.." aria-controls="DataTables_Table_0" id="search-input">
            </label></div>
          <div class="dt-buttons btn-group flex-wrap">

            <button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Ajouter un nouvel Service</span></span></button>
          </div>
        </div>
      </div>
    </div>
    <table class="datatables-users table">
      <thead class="border-top">
        <tr>
          <th>Designations</th>
          <th>prix</th>
          <th>categories</th>
          <th>capacite</th>
          <th>durée</th>
          <th>Pause (minutes) </th>
          <th>Promotion</th>
          <th>Méthode de Tarification</th>
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
        destroy: true,

        ajax: {
          url: '/searchServices',
          data: function(d) {
            d.search = $('#search-input').val();
            d.pays = $('#UserRole').val();
          }
        },
        columns: [{
            data: 'Designations',
            title: 'Designations'
          },
          {
            data: 'prix',
            title: 'prix'
          },
          {
            data: 'categories',
            title: 'categories'
          },
          {
            data: 'capacite',
            title: 'capacite'
          },
          {
            data: 'duree',
            title: 'durée'
          },
          {
            data: 'Pause',
            title: 'Pause'
          },
          {
            data: 'Promotion',
            title: 'Promotion'
          },
          {
            data: 'MethodedeTarification',
            title: 'Methode de Tarification'
          },

          {
            data: 'actions',
            title: 'Actions',
            orderable: false,
            searchable: false
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

    });
  </script>

  <style>
    /* Hide the search input */
    #DataTables_Table_0_filter {
      display: none;
    }
  </style>

  <!-- Offcanvas to add new user -->

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Ajouter un service</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" method="POST" action="/addService" enctype="multipart/form-data" id="myForm">
        @csrf

        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Designations</label>
          <input type="text" value="{{ old('Designations') }}" class="form-control @error('Designations') is-invalid @enderror" name="Designations" required placeholder="votre Designations" data-parsley-minlength="4">
          @error('Designations')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>


        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Description</label>
          <textarea class="form-control @error('Description') is-invalid @enderror" id="Description" name="Description" required placeholder="Votre Description" data-parsley-minlength="4">{{ old('Description') }}</textarea>
          @error('Description')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label" for="methode_tarification">Méthode de tarification</label>
          <select name="methode_tarification" class="form-control @error('methode_tarification') is-invalid @enderror" id="methode_tarification" required autocomplete="methode_tarification">
            <option value="">Sélectionnez une méthode de tarification</option>
            <option value="par_place" @if(old('methode_tarification')=='par_place' ) selected @endif>Par place</option>
            <option value="par_reservation" @if(old('methode_tarification')=='par_reservation' ) selected @endif>Par réservation</option>
          </select>
          @error('methode_tarification')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mb-3" id="dureContainer">
          <label class="form-label" for="add-user-fullname">capacite</label>
          <input type="number" value="{{ old('capacite') }}" class="form-control @error('capacite') is-invalid @enderror" id="capacite" name="capacite" placeholder="votre capacite">
          @error('capacite')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Durée</label>
          <div class="input-group">
            <input type="number" value="{{ old('dure_hours') }}" class="form-control @error('dure_hours') is-invalid @enderror" id="dure_hours" name="dure_hours" placeholder="Heures">
            <span class="input-group-text">h</span>
            <input type="number" value="{{ old('dure_minutes') }}" class="form-control @error('dure_minutes') is-invalid @enderror" id="dure_minutes" name="dure_minutes" placeholder="Minutes">
            <span class="input-group-text">m</span>

          </div>
          <div id="error-message"></div>
          @error('dure_heures')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          @error('dure_minutes')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Pause (minutes)</label>
          <input type="number" value="{{ old('pause') }}" class="form-control @error('pause') is-invalid @enderror" name="pause" placeholder="pause">
          @error('pause')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="add-user-email">Prix</label>
          <input type="number" value="{{ old('prix') }}" class="form-control @error('prix') is-invalid @enderror" name="prix" placeholder="votre prix" required="">
          @error('prix')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Promotion</label>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="promotion" name="promotion" @if(old('promotion')) checked @endif>
            <label class="form-check-label" for="promotion">Activer la promotion</label>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-contact">categories</label>
          <select name="categories" class="form-control @error('categories') is-invalid @enderror" required autocomplete="categories">
            <option value="">Select categories</option>
            <option value="MASSAGES" @if(old('categories')=='MASSAGES' ) selected @endif>MASSAGES</option>
            <option value="SOINS ESTHÉTIQUES" @if(old('categories')=='SOINS ESTHÉTIQUES' ) selected @endif>SOINS ESTHÉTIQUES</option>

            <option value="PRESTATIONS THERMALES" @if(old('categories')=='PRESTATIONS THERMALES' ) selected @endif>PRESTATIONS THERMALES</option>

            <option value="LA COLINA LOUNGE et CLUB" @if(old('categories')=='LA COLINA LOUNGE et CLUB' ) selected @endif>LA COLINA LOUNGE & CLUB</option>
            <option value="VOS ÉVÉNEMENTS" @if(old('categories')=='VOS ÉVÉNEMENTS' ) selected @endif>VOS ÉVÉNEMENTS</option>

            <option value="BUNGALOWS" @if(old('categories')=='BUNGALOWS' ) selected @endif>BUNGALOWS</option>




          </select>
        </div>

        <div class="mb-3">
          <label class="form-label" for="country">Image</label>
          <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required placeholder="Email Address">
          @error('image')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>



        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit" id="submitButton">Ajouter</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>


  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUpdateService" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Modifier un service</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" method="POST" action="/addService" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Designations</label>
          <input type="text" value="{{ old('Designations') }}" class="form-control @error('Designations') is-invalid @enderror" name="Designations" required placeholder="votre Designations" data-parsley-minlength="4">
          @error('Designations')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Prix</label>
          <input type="number" value="{{ old('prix') }}" class="form-control @error('prix') is-invalid @enderror" name="prix" placeholder="votre prix" required="">
          @error('prix')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-contact">categories</label>
          <select name="categories" class="form-control @error('categories') is-invalid @enderror" required autocomplete="categories">
            <option value="">Select categories</option>
            <option value="PRESTATIONS THERMALES" @if(old('categories')=='PRESTATIONS THERMALES' ) selected @endif>PRESTATIONS THERMALES</option>
            <option value="MASSAGES ET SOINS" @if(old('categories')=='MASSAGES ET SOINS' ) selected @endif>MASSAGES ET SOINS</option>
            <option value="LA COLINA LOUNGE et  CLUB - BUNGALOWS" @if(old('categories')=='LA COLINA LOUNGE et  CLUB - BUNGALOWS' ) selected @endif>LA COLINA LOUNGE et CLUB - BUNGALOWS</option>




          </select>
        </div>

        <div class="mb-3">
          <label class="form-label" for="country">Image</label>
          <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required placeholder="Email Address">
          @error('image')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>



        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Ajouter</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    // Hide the "durée (heure)" input initially
    $('#dureContainer').hide();

    // Listen for changes in the "methode_tarification" select
    $('#methode_tarification').change(function() {
      // If "par_reservation" is selected, hide the "durée (heure)" input, else show it
      if ($(this).val() === 'par_reservation') {
        $('#dureContainer').hide();
        $('#capacite').prop('required', false); // Make capacite not required
      } else {
        $('#dureContainer').show();
        $('#capacite').prop('required', true); // Make capacite required
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#submitButton').click(function() {
      var dureHours = $('#dure_hours').val();
      var dureMinutes = $('#dure_minutes').val();

      // Check if at least one of the fields has a value
      if (dureHours === '' && dureMinutes === '') {
        $('#error-message').css('color', 'red');
        $('#error-message').html('Veuillez entrer au moins une valeur pour la durée, en heures ou en minutes.');
        return false; // Prevent form submission
      }

      // If at least one field is filled, submit the form

    });
  });
</script>

@endsection