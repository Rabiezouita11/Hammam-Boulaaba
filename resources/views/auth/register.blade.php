<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<link href="client/fr/assets/css/bootstrap.min.css" rel="stylesheet">
<!-- Icofont css -->
<link href="client/fr/assets/css/icofont.css" rel="stylesheet">
<!-- Owl.carousel css -->
<link href="client/fr/assets/css/owl.carousel.css" rel="stylesheet">
<!-- Animate css -->
<link href="client/fr/assets/css/animate.min.css" rel="stylesheet">
<!-- Magnific popup css -->
<link href="client/fr/assets/css/magnific-popup.css" rel="stylesheet">
<!-- Jquery-ui css -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Style css -->
<link href="client/fr/assets/css/style.css" rel="stylesheet">
<!-- Responsive css -->
<link href="client/fr/assets/css/responsive.css" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="container">
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>Inscription</h2>
                        <div class="bar"></div>
                    </div>
                </div>
            </div><!-- End row -->

            <div class="row">

            <div class="col-lg-4">
    <a href="/home">
        <img src="logo.png" alt="Image Description">
    </a>
</div>

                <div class="col-lg-8">
                    <div class="contact-form" style="padding: 100px; ">

                        <form method="POST" action="/register" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="role" value="client">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="contact_name" name="name" placeholder="Your Name" required="" data-parsley-minlength="4">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="contact_email" name="email" placeholder="Email Address" required="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="genre" class="form-control @error('genre') is-invalid @enderror" id="" required autocomplete="genre">
                                        <option value="">Select genre</option>
                                        <option value="Femme" @if(old('genre')=='Femme' ) selected @endif>Femme</option>
                                        <option value="Homme" @if(old('genre')=='Homme' ) selected @endif>Homme</option>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <select name="pays" id="pays" class="form-control mb-1" required>
                                        @foreach ($countries as $countryCode => $countryName)
                                        <option value="{{ $countryCode }}" @if ($countryName==='Tunisia' ) selected @endif>{{ $countryName }}</option>
                                        @endforeach
                                    </select>


                                </div>
                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="contact_email" name="image" placeholder="Email Address">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="col-md-6">
                                    <input id="phone" value="{{ old('phone') }}" type="tel" class="form-control" name="phone" required="" />
                                    <span id="phone-error" class="invalid-feedback" role="alert" style="display: none;"></span>
                                </div>


                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Votre mot de passe" required data-parsley-minlength="4">
                                        <div class="input-group-append">
                                            <button class="form-control toggle-password" type="button"><i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Confirmez le mot de passe" required data-parsley-minlength="4">
                                        <div class="input-group-append">
                                            <button class="form-control toggle-password-confirmation" type="button"><i class="fas fa-eye"></i></button>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="g-recaptcha" data-sitekey="6LctnvAoAAAAALMM73Ap3KHVzujN6R6saENhGzyp" required=""></div>

                                    @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                </div>

                                <div id="contact_send_status"></div>
                                <div style="text-align: center;">
                                    <button type="submit" class="btn default-button"> s'inscrire</button>

                                </div>
                        </form>
                        <center>
                            <a class="btn btn-link" href="login">
                                J'ai déjà un compte
                            </a>

                        </center>
                    </div>
                </div>


            </div><!-- End row -->
        </div>
    </section>

</div>
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

<script>
    // Get a reference to the password input and the toggle button for password
    const passwordInput = document.querySelector('input[name="password"]');
    const toggleButton = document.querySelector('.toggle-password');

    // Add a click event listener to the toggle button for password
    toggleButton.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text'; // Change the input type to text to show the password
        } else {
            passwordInput.type = 'password'; // Change the input type back to password to hide the password
        }
    });
</script>
<script>
    // Get a reference to the password input and the toggle button for password_confirmation
    const passwordInputConfirmation = document.querySelector('input[name="password_confirmation"]');
    const toggleButtonConfirmation = document.querySelector('.toggle-password-confirmation');

    // Add a click event listener to the toggle button for password_confirmation
    toggleButtonConfirmation.addEventListener('click', function() {
        if (passwordInputConfirmation.type === 'password') {
            passwordInputConfirmation.type = 'text'; // Change the input type to text to show the password
        } else {
            passwordInputConfirmation.type = 'password'; // Change the input type back to password to hide the password
        }
    });
</script>