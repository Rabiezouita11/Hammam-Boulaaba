@extends ('Frontoffice.layouts.index')

@section ('content')
@php
use Stichoza\GoogleTranslate\GoogleTranslate;
@endphp

{{-- Get the current locale --}}
@php
$currentLocale = app()->getLocale();
@endphp

{{-- Create an instance of GoogleTranslate --}}
@php
$translator = new GoogleTranslate();
$translator->setSource($currentLocale);
$translator->setTarget($currentLocale); // Set the target language based on the current locale
$translatedLocale = $translator->translate(strtoupper(app()->getLocale()));

@endphp


<style>
  .slider-text-content {
    margin: auto;
    max-width: 80%;
    padding: 20px;
  }

  h1 {
    font-size: 2em;
    color: #104d93;
  }

  p {
    color: white;
  }

  /* Media query for smaller screens */
  @media (max-width: 767px) {
    .slider-text-content {
      max-width: 100%;
    }

    h1 {
      font-size: 1.5em;
      margin-top: 0;
    }
  }
</style>
<div id="home" class="home-slider">
    <div class="single-item item-bg-1">
        <div class="d-table">
            <div class="d-tablecell">
                <div class="slider-text-content" >
                    <h1 style="font-size:47px;color:#104d93"> {{ $translator->translate('Station Thermale Hammam Boulâaba : Votre adresse de bien-être') }} </h1>
                    <p style="color:white"> {{ $translator->translate('Plonger dans l\'authentique expérience de nos hammams et piscines et
bénéficier des bienfaits de notre eau thermale minérale à 48°C et
d\'un large panel de soins esthétiques et de massages.') }} </p>
                    <a class="slider-btn-two" href="#services"> {{ $translator->translate('Réserver') }} </a>
                    <a class="slider-btn-two" href="#services"> {{ $translator->translate('Our Services') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="single-item item-bg-2">
        <div class="d-table">
            <div class="d-tablecell">
                <div class="slider-text-content" >
                    <h1 style="font-size:47px;color:#104d93">


                        @if($currentLocale === 'fr')
                        LA COLINA Lounge & Club
                        @else
                        {{ $translator->translate('LA COLINA Lounge & Club') }}

                        @endif

                        <p style="color: white;"> {{ $translator->translate('Le lounge s\'ouvre directement sur le paddock des chevaux pur sang arabes et vous permet de profiter d\'une vue sur montagne. Nous sommes adaptés pour l\'accueil de vos événements, vos repas en famille ou avec amis, ainsi que pour vos fêtes et vos conférences. Vous pouvez déguster nos plats et nos délices dans une ambiance décontractée en pleine nature.') }} </p>
                        <a class="slider-btn-two" href="#services">{{ $translator->translate('Réserver') }} </a>
                        <a class="slider-btn-two" href="#services">{{ $translator->translate('Our Services') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="single-item item-bg-3">
        <div class="d-table">
            <div class="d-tablecell">
                <div class="slider-text-content" >
                    <h1 style="font-size:47px;color:#104d93">


                        @if($currentLocale === 'fr')
                        Nos bungalows :
                        @else
                        {{ $translator->translate('Nos bungalows :') }}
                        @endif

                    </h1>
                    <p> {{ $translator->translate('Nous serons heureux de vous accueillir, pour vous faire partager notre coin de paradis. Nos jolis bungalows meublés font face au paddocks des chevaux et à notre lounge et club La Colina.') }} </p>
                    <a class="slider-btn-two" href="#services">{{ $translator->translate('Réserver') }}</a>
                    <a class="slider-btn-two" href="#services">{{ $translator->translate('Our Services') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add this at the top of your Blade file -->


<section id="services" class="our-shop">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>{{ $translator->translate('Nos services') }}</h2>
                    <div class="bar"></div>



                </div>
            </div>
        </div><!-- End row -->

        <div class="row">
            <div class="col-md-12">
                <div class="product-carousel zoom-gallery">
                    @foreach ($servicesByCategory as $categoryName => $services)

                    @foreach ($services as $service)

                    <div class="single-service">
                        <img class="service-image" src="/storage/{{ $service->image }}" width="250px" height="250px" alt="" />
                        <h3>
                            {{-- Dynamically translate service name --}}
                         
                           {{$translator->translate($service->Designations)}} 
                        </h3>
                        <a href="/service_{{ $service->id }}" class="default-button" role="button"> {{ $translator->translate('Réserver') }}</a>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div><!-- End row -->


    </div>
</section>


<section class="special-services">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>Our Special Services</h2>
                    <div class="bar"></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
            </div>
        </div><!-- End row -->

        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="special-single-service">
                    <img src="client/fr/assets/img/sp_service_1.png" alt="" />
                    <h3>Hair Cut Bundle</h3>
                    <a href="#AppointmentModal" class="default-button" role="button" data-bs-toggle="modal">Appointment</a>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="special-single-service">
                    <img src="client/fr/assets/img/sp_service_2.png" alt="" />
                    <h3>Spa with orchid</h3>
                    <a href="#AppointmentModal" class="default-button" role="button" data-bs-toggle="modal">Appointment</a>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="special-single-service">
                    <img src="client/fr/assets/img/sp_service_3.png" alt="" />
                    <h3>Green Cream Pack</h3>
                    <a href="#AppointmentModal" class="default-button" role="button" data-bs-toggle="modal">Appointment</a>
                </div>
            </div>
        </div><!-- End row -->
    </div>
</section>




<section id="shop" class="our-shop">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>Our Shop</h2>
                    <div class="bar"></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
            </div>
        </div><!-- End row -->

        <div class="row">
            <div class="col-md-12">
                <div class="product-carousel zoom-gallery">
                    <div class="product-item">
                        <a href="#" class="product-img">
                            <img src="client/fr/assets/img/product_1.png" alt="" />
                        </a>
                        <h3>Therapeutic massage</h3>
                        <ul>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                        </ul>
                        <p class="price">$35.00</p>
                        <a href="#" class="default-button">Add to cart</a>
                    </div>

                    <div class="product-item">
                        <a href="#" class="product-img">
                            <img src="client/fr/assets/img/product_2.png" alt="" />
                        </a>
                        <h3>Face Powder Refill</h3>
                        <ul>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                        </ul>
                        <p class="price">$35.00</p>
                        <a href="#" class="default-button">Add to cart</a>
                    </div>

                    <div class="product-item">
                        <a href="#" class="product-img">
                            <img src="client/fr/assets/img/product_3.png" alt="" />
                        </a>
                        <h3>Face & Neck Oil 30ml</h3>
                        <ul>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                        </ul>
                        <p class="price">$35.00</p>
                        <a href="#" class="default-button">Add to cart</a>
                    </div>

                    <div class="product-item">
                        <a href="#" class="product-img">
                            <img src="client/fr/assets/img/product_4.png" alt="" />
                        </a>
                        <h3>Concealer Stick</h3>
                        <ul>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                        </ul>
                        <p class="price">$35.00</p>
                        <a href="#" class="default-button">Add to cart</a>
                    </div>

                    <div class="product-item">
                        <a href="#" class="product-img">
                            <img src="client/fr/assets/img/product_5.png" alt="" />
                        </a>
                        <h3>Foundation Primer</h3>
                        <ul>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                            <li><i class="icofont icofont-star"></i></li>
                        </ul>
                        <p class="price">$35.00</p>
                        <a href="#" class="default-button">Add to cart</a>
                    </div>
                </div>
            </div>
        </div><!-- End row -->
    </div>
</section>

<section id="price" class="our-price section-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>Our Price Table</h2>
                    <div class="bar"></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
            </div>
        </div><!-- End row -->

        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="single-price-table">
                    <h2>Basic Plan</h2>
                    <h3>$500 <span>/mo</span></h3>
                    <ul>
                        <li>Relaxing Massage</li>
                        <li>Body Polish</li>
                        <li>Signature Facial</li>
                        <li>Relaxing Massage</li>
                        <li>Body Polish</li>
                        <li>Signature Facial</li>
                    </ul>
                    <a href="#" class="default-button">Buy it Now</a>
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="single-price-table">
                    <h2>Professional</h2>
                    <h3>$900 <span>/mo</span></h3>
                    <ul>
                        <li>Relaxing Massage</li>
                        <li>Body Polish</li>
                        <li>Signature Facial</li>
                        <li>Relaxing Massage</li>
                        <li>Body Polish</li>
                        <li>Signature Facial</li>
                    </ul>
                    <a href="#" class="default-button">Buy it Now</a>
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="single-price-table">
                    <h2>Exclusive</h2>
                    <h3>$1500 <span>/mo</span></h3>
                    <ul>
                        <li>Relaxing Massage</li>
                        <li>Body Polish</li>
                        <li>Signature Facial</li>
                        <li>Relaxing Massage</li>
                        <li>Body Polish</li>
                        <li>Signature Facial</li>
                    </ul>
                    <a href="#" class="default-button">Buy it Now</a>
                </div>
            </div>
        </div><!-- End row -->
    </div>
</section>



<!-- End subscribe section -->

<!-- Start contact section -->
<section id="contact" class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2> {{ $translator->translate('Contact Us') }} </h2>
                    <div class="bar"></div>
                </div>
            </div>
        </div><!-- End row -->

        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form">
                    <form id="contact_form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="contact_name" name="name" placeholder="{{ $translator->translate('Your Name') }}" required="" data-parsley-minlength="4">
                            </div>

                            <div class="col-md-6">
                                <input type="email" class="form-control" id="contact_email" name="email" placeholder="{{ $translator->translate('Email Address') }}" required="">
                            </div>
                        </div>

                        <input type="text" class="form-control" id="contact_subject" name="sub" placeholder="{{ $translator->translate('Subject') }}" required="" data-parsley-minlength="4">

                        <textarea class="form-control" id="contact_message" name="message" rows="5" placeholder=" {{ $translator->translate('Type here message...') }}" required="" data-parsley-trigger="keyup" data-parsley-minlength="10" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 10 character comment.." data-parsley-validation-threshold="10"></textarea>

                        <div id="contact_send_status"></div>

                        <button type="submit" class="btn default-button" id="submit_button"> {{ $translator->translate('Envoyer le message') }} </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-info">
                    <h3> {{ $translator->translate('Coordonnées') }} </h3>
                    <ul>
                        <li>
                            <i class="icofont icofont-location-arrow"></i>
                            {{ $translator->translate('Station Thermale Hammam Boulâaba') }}
                        </li>
                        <li>
                            <i class="icofont icofont-phone"></i>
                            {{ $translator->translate('Téléphone ') }} : +216 55 520 540
                        </li>
                        <li>
                            <i class="icofont icofont-envelope"></i>
                            contact@hammamboulaaba.com
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- End row -->
    </div>
</section>
<script>
    $(document).ready(function() {
        $("#contact_form").submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Collect the form data
            var formData = {
                name: $("#contact_name").val(),
                email: $("#contact_email").val(),
                sub: $("#contact_subject").val(),
                messages: $("#contact_message").val()
            };
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send the data using AJAX
            $.ajax({
                type: "POST",
                url: "/contact", // The URL to your Laravel controller action
                data: formData,
                success: function(response) {
                    // Handle the response from the server
                    $("#contact_send_status").html(response);
                    displayMessage(response.message);
                },
                error: function(xhr, status, error) {
                    // Handle the error and display a toastr message
                    var errorMessage = 'An error occurred: ' + error;
                    displayMessageErreur(errorMessage);
                }
            });
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
    #toast-container>.toast-success {
        background-color: green !important;
        /* Use !important to override any inline styles */
    }

    #toast-container>.toast-error {
        background-color: red !important;
        /* Use !important to override any inline styles */
    }
</style>

@endsection