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
                    <img src="/logo.png  " alt="Image Description">
                </div>
                <div class="col-lg-8">
                    <div class="contact-form" style="padding: 100px;">
                        <form method="POST" action="/password/reset">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">


                            <div class="row">
                                <div class="col-md-10">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-10">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="nouveau mot de passe" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation mot de passe" required autocomplete="new-password">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                            <div id="contact_send_status"></div>
                            <div style="text-align: center;">
                                <button type="submit" class="btn default-button"> réinitialiser le mot de passe</button>

                            </div>
                        </form>
                    </div>
                </div>


            </div><!-- End row -->
        </div>
    </section>

</div>