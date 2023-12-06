@extends('layouts/layoutMaster')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

@section('title', 'User List - Pages')

@section('vendor-style')
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

@endsection

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

  @if($errors -> has('name'))
  $(document).ready(function() {
    // Show the password modal if there are validation errors
    $('.offcanvasAddUser').modal('show');
  });
  @endif
</script>
<style>
  /* Add this CSS style to make all cards the same height */
  .custom-card {
    height: 100%;
  }
</style>
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card custom-card d-flex flex-column h-100">
      <div class="card-body d-flex flex-column justify-content-between flex-fill">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Total utilisateurs</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">{{ $clientUsersCount }}</h3>
            </div>

          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="fas fa-users fa-2x"></i> <!-- Increase the size to 2x -->
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
            <span>Nombre des utilisateurs femmes</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">{{$femaleUserCount}}</h3>
            </div>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-danger">

              <i class="fas fa-female fa-2x"></i> <!-- Increase the size to 2x -->

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
            <span>Nombre des utilisateurs hommes</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">{{$maleUserCount}}</h3>
            </div>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-success">
              <i class="fas fa-male fa-2x"></i> <!-- Use the "male" icon -->
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


<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title mb-3">Search Filter</h5>
    <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
      <div class="col-md-4 user_role">
        <select id="UserRole" class="form-select text-capitalize">
          <option value="">Select pays</option>
          @foreach ($countries as $countryCode => $countryName)
          <option value="{{ $countryCode }}">{{ $countryName }}</option>
          @endforeach
        </select>

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
            <div class="btn-group">
              <style>
                .btn.btn-secondary.buttons-collection.dropdown-toggle.btn-label-secondary.mx-3 {
                  display: none;
                }
              </style>
              <button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-secondary mx-3" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">

              </button>
            </div>
            <button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Ajouter un nouvel utilisateur</span></span></button>
          </div>
        </div>
      </div>
    </div>
    <table class="datatables-users table">
      <thead class="border-top">
        <tr>
          <th>User</th>
          <th>Role</th>
          <th>pays</th>
          <th>numero</th>
          <th>genre</th>
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

        ajax: {
          url: '/search',
          data: function(d) {
            d.search = $('#search-input').val();
            d.pays = $('#UserRole').val();
          }
        },
        columns: [{
            data: 'name',
            title: 'User'
          },
          {
            data: 'role',
            title: 'Role'
          },
          {
            data: 'pays',
            title: 'Pays'
          },
          {
            data: 'numero',
            title: 'Numero'
          },
          {
            data: 'genre',
            title: 'Genre'
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
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Ajouter un utilisateur</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" id="addNewUserForm" method="POST" action="/addUser" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Nom</label>
          <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your Name" data-parsley-minlength="4" required="">
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" required="">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-contact">genre</label>
          <select name="genre" class="form-control @error('genre') is-invalid @enderror" id="" required autocomplete="genre" required="">
            <option value="">Select genre</option>
            <option value="Femme" @if(old('genre')=='Femme' ) selected @endif>Femme</option>
            <option value="Homme" @if(old('genre')=='Homme' ) selected @endif>Homme</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-company">pays</label>
          <select name="pays" id="pays" class="form-control mb-1" required>
            @foreach ($countries as $countryCode => $countryName)
            <option value="{{ $countryCode }}" @if ($countryName==='Tunisia' ) selected @endif>{{ $countryName }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="country">Image</label>
          <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="Email Address">
          @error('image')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>
        <div class="mb-3">
          <label class="form-label" for="user-role">Numero telephone</label>
          <input id="phone" value="{{ old('phone') }}" type="tel" class="form-control" name="phone" required="" />
          <span id="phone-error" class="invalid-feedback" role="alert" style="display: none;"></span>

        </div>
        <div class="mb-4">
          <label class="form-label" for="user-plan">Mot de passe</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Votre mot de passe" required="">
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>
        <div class="mb-4">
          <label class="form-label" for="user-plan">Confirmez le mot de passe</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Confirmez le mot de passe" required="">


        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Ajouter</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
</div>

@endsection
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const phoneInputField = document.querySelector("#phone");
    const countryDropdown = document.querySelector("#pays");
    const phoneError = document.querySelector("#phone-error");
    const submitButton = document.querySelector("button[type='submit']");

    const phoneInput = window.intlTelInput(phoneInputField, {
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
      initialCountry: "tn",
      nationalMode: false,
    });

    let previousInputValue = phoneInputField.value; // Store the previous input value

    function showErrorMessage(message) {
      phoneError.style.display = "block";
      phoneError.innerHTML = message;
    }

    function hideErrorMessage() {
      phoneError.style.display = "none";
    }

    function validatePhoneNumber() {
      const inputValue = phoneInputField.value;
      const selectedCountryData = phoneInput.getSelectedCountryData();
      const selectedCountryPrefix = selectedCountryData.dialCode;

      // Check if the input value has changed
      if (inputValue !== previousInputValue) {
        previousInputValue = inputValue; // Update the previous input value

        const isValidNumber = phoneInput.isValidNumber();

        if (!isValidNumber && inputValue !== "") {
          showErrorMessage(`Le numéro de téléphone doit commencer par +${selectedCountryPrefix} pour ${selectedCountryData.name}.`);
          submitButton.disabled = true;
        } else {
          hideErrorMessage();
          submitButton.disabled = false;
        }
      }
    }

    // Listen for blur event on phone input field to trigger validation
    phoneInputField.addEventListener("blur", validatePhoneNumber);

    // Listen for change event on country dropdown to update phone validation
    countryDropdown.addEventListener("change", function() {
      const selectedCountry = this.value;
      phoneInput.setCountry(selectedCountry);
      hideErrorMessage();
      validatePhoneNumber();
    });

    // Trigger initial validation
    validatePhoneNumber();
  });
</script>