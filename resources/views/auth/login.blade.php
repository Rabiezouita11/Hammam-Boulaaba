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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container">
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>se connecter</h2>
                        <div class="bar"></div>
                    </div>
                </div>
            </div><!-- End row -->
            <center>
                <div class="row">
                <div class="col-lg-4">
    <a href="/home">
        <img src="logo.png" alt="Image Description">
    </a>
</div>
                    <div class="col-lg-8">
                        <div class="contact-form" style="padding: 100px;">
                            <form method="POST" action="/login">
                                @csrf


                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            placeholder="Votre Email" required="" data-parsley-minlength="4">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="password" value="{{ old('password') }}"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="Votre mot de passe" required
                                                data-parsley-minlength="4">
                                            <div class="input-group-append">
                                                <button class="form-control toggle-password" type="button"><i
                                                        class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <script>
                                    // Get a reference to the password input and the toggle button
                                    const passwordInput = document.querySelector('input[type="password"]');
                                    const toggleButton = document.querySelector('.toggle-password');

                                    // Add a click event listener to the toggle button
                                    toggleButton.addEventListener('click', function() {
                                        if (passwordInput.type === 'password') {
                                            passwordInput.type = 'text'; // Change the input type to text to show the password
                                        } else {
                                            passwordInput.type = 'password'; // Change the input type back to password to hide the password
                                        }
                                    });
                                </script>





                                <div id="contact_send_status"></div>
                                <div style="text-align: center;">
                                    <button type="submit" class="btn default-button">se connecter</button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="password/reset">
                                            {{ __('Mot de passe oublié?') }}
                                        </a>
                                    @endif
                                    <br>
                                    <br>

                                    <a class="btn btn-link" href="register">
                                        Vous n'avez pas encore de compte ? S'inscrire
                                    </a>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-info">

                            <!-- <img src="ex.jpg" alt="" height="500px" width="500px" srcset=""> -->

                        </div>
                    </div>

                </div><!-- End row -->
            </center>
        </div>
    </section>

</div>
<style>

</style>
