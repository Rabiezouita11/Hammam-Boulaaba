<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<link href="/client/fr/assets/css/bootstrap.min.css" rel="stylesheet">
<!-- Icofont css -->
<link href="/client/fr/assets/css/icofont.css" rel="stylesheet">
<!-- Owl.carousel css -->
<link href="/client/fr/assets/css/owl.carousel.css" rel="stylesheet">
<!-- Animate css -->
<link href="/client/fr/assets/css/animate.min.css" rel="stylesheet">
<!-- Magnific popup css -->
<link href="/client/fr/assets/css/magnific-popup.css" rel="stylesheet">
<!-- Jquery-ui css -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Style css -->
<link href="/client/fr/assets/css/style.css" rel="stylesheet">
<!-- Responsive css -->
<link href="/client/fr/assets/css/responsive.css" rel="stylesheet">
<div class="container">
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>réinitialiser le mot de passe</h2>
                        <div class="bar"></div>
                    </div>
                </div>
            </div><!-- End row -->

            <div class="row">
            <div class="col-lg-4">
                        <img src="/logo.png" alt="Image Description">
                    </div>
                <div class="col-lg-8">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="contact-form" style="padding: 100px;">
                        <form method="POST" action="/password/email">
                            @csrf

                            <div class="row">


                                <div class="col-md-10">
                                    <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="contact_email" name="email" placeholder="Email Address" required="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>




                            <div id="contact_send_status"></div>
                            <div style="text-align: center;">
                                <button type="submit" class="btn default-button"> Envoyer le lien de réinitialisation du mot de passe</button>

                            </div>
                        </form>
                    </div>
                </div>


            </div><!-- End row -->
        </div>
    </section>

</div>

</script>