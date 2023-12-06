<!DOCTYPE html>
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
<html lang="{{ $currentLocale }}" @if($currentLocale==='ar' ) dir="rtl" @endif>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/logo station thermale-01.png" rel="icon">
    <link href="/logo station thermale-01.png" rel="apple-touch-icon">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Site Title -->
    <title>Hammam Boulaaba</title>
    <!-- Bootstrap css -->
    @if($currentLocale === 'ar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif <!-- Icofont css -->
    <link href="https://cdn.jsdelivr.net/npm/icofont@1.0.0/dist/icofont.min.css" rel="stylesheet">
    <!-- Owl.carousel css -->
    <link href="/client/{{ $currentLocale }}/assets/css/owl.carousel.css" rel="stylesheet">
    <!-- Animate css -->
    <link href="/client/{{ $currentLocale }}/assets/css/animate.min.css" rel="stylesheet">
    <!-- Magnific popup css -->
    <link href="/client/{{ $currentLocale }}/assets/css/magnific-popup.css" rel="stylesheet">
    <!-- Jquery-ui css -->
    <!-- Style css -->
    <link href="/client/{{ $currentLocale }}/assets/css/style.css" rel="stylesheet">
    <!-- Responsive css -->
    <link href="/client/{{ $currentLocale }}/assets/css/responsive.css" rel="stylesheet">
    @if($currentLocale === 'ar')
    <link href="/client/{{ $currentLocale }}/assets/css/rtl.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" >

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/assets/fullcalendar/dist/index.global.js"></script>
    <link rel="stylesheet" href="/cssFrontoffice.css">

    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/bs-stepper/bs-stepper.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/rateyo/rateyo.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />
    <link rel="stylesheet" href="/assets/vendor/css/pages/wizard-ex-checkout.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="/jsFrontoffice.js" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- link calender -->
    <script>
        $(document).ready(function() {
            // Check if the session variable 'azer' is set
            @if(session('passwordChangeSuccess'))
            // Show the success modal
            $('#passwordChangeSuccessModal').modal('show');
            @endif
            @if(session('profilechanger'))
            // Show the success modal
            $('#profileChanger').modal('show');
            @endif



        });
    </script>



    <script>
        @if($errors -> has('old_password') || $errors -> has('new_password') || $errors -> has('confirm_password'))
        $(document).ready(function() {
            // Show the password modal if there are validation errors
            $('.passwordModal').modal('show');
        });
        @endif
    </script>

</head>

<!-- Include this in your Blade file -->


<body data-bs-spy="scroll" data-bs-offset="70">

    <!-- Start preloader -->
    <div class="preloader-wrap">
        <div class="loader">
            <div class="loader-inner">
                <div class="loader-inner">
                    <div class="loader-inner">
                        <div class="loader-inner">
                            <div class="loader-inner">
                                <div class="loader-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End preloader -->
    <style>
        .navbar .navbar-nav>li>a {
            text-transform: none;
                color: #104d93;
                font-size: 13px;
    text-transform: uppercase;
    font-weight: 500;
    padding: 2px 0;
    margin: 12px 12px;
    border-bottom: 2px solid transparent;
        }
    </style>
    <style>
    .navbar-collapse{
        text-align: center;
    }
</style>
    <style>
        body {

            padding: 0 !important;
            ;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif !important;
            font-size: 14px !important;
            ;
        }

        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }

        @media (min-width: 300px) {
            .d-sm-block {
                display: block !important
            }
        }
    </style>



    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    @if($currentLocale === 'ar')
    <a href="/home">
    <img src="/LOGO SITE WEBHA-01.png" alt="logo" style="height: 66px; padding-left: 1px; padding-right: 394px; max-width: none;">
</a>


        @else 
        <a href="/home">
            <img src="/LOGO SITE WEBHA-01.png" alt="logo" style="height: 66px; padding-left:49px">
        </a>

        @endif

        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">

                    <li class="dropdown d-none d-sm-block" id="hover-dropdown1">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            @php
                            $flagClass = strtolower($translatedLocale) === 'ar' ? 'flag-icon-tn' : 'flag-icon-' . strtolower($translatedLocale);
                            @endphp

                            <span class="flag-icon {{ $flagClass }}"></span> {{ $translatedLocale }} </a>
                        <ul class="dropdown-menu">
                            <div class="shop-cart">
                                <div class="product-text">
                                    <a class="dropdown-item" href="/lang/ar">
                                        <span class="flag-icon flag-icon-tn"></span> {{ $translator->translate('Arabic') }}
                                    </a>
                                </div>
                            </div>
                            <div class="shop-cart">
                                <div class="product-text">
                                    <a class="dropdown-item" href="/lang/fr">
                                        <span class="flag-icon flag-icon-fr"></span> {{ $translator->translate('French') }}
                                    </a>
                                </div>
                            </div>
                        </ul>
                    </li>

                    <li class="active"><a href="/home"> {{ $translator->translate('Accueil') }} </a></li>


                    {{-- Loop through your services --}}


                    <li class="dropdown d-none d-sm-block" id="hover-dropdown2">
                        <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ $translator->translate('PRESTATIONS THERMALES') }}
                        </a>
                        <ul class="dropdown-menu">
                            @forelse($Service as $service)
                            @if ($service->categories === 'PRESTATIONS THERMALES')
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Automatically detect source language and translate the category name --}}
                                   
                                    <a style="color:#104d93" href="/service_{{ $service->id }}">{{ $translator->translate($service->Designations) }}</a>
                                </div>
                            </div>
                            @endif
                            @empty
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Translate the no articles message --}}
                                    @php
                                    $noArticlesMessage = $translator->translate('Aucun article disponible dans cette catégorie.');
                                    @endphp
                                    <p>{{ $noArticlesMessage }}</p>
                                </div>
                            </div>
                            @endforelse
                        </ul>
                    </li>

                    <li class="dropdown d-none d-sm-block" id="hover-dropdown3">
                        <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ $translator->translate('MASSAGES') }}
                        </a>
                        <ul class="dropdown-menu">
                            @forelse($Service as $service)
                            @if ($service->categories === 'MASSAGES')
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Automatically detect source language and translate the category name --}}
                                   
                                    <a style="color:#104d93" href="/service_{{ $service->id }}">{{ $translator->translate($service->Designations) }}</a>
                                </div>
                            </div>
                            @endif
                            @empty
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Translate the no articles message --}}
                                    @php
                                    $noArticlesMessage = $translator->translate('Aucun article disponible dans cette catégorie.');
                                    @endphp
                                    <p>{{ $noArticlesMessage }}</p>
                                </div>
                            </div>
                            @endforelse
                        </ul>
                    </li>


                    <li class="dropdown d-none d-sm-block" id="hover-dropdown4">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ $translator->translate('SOINS ESTHÉTIQUES') }} </a>
                        <ul class="dropdown-menu">
                            <!-- List your categories here -->
                            @forelse($Service as $service)
                            @if ($service->categories === 'SOINS ESTHÉTIQUES')
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Automatically detect source language and translate the category name --}}
                                   
                                    <a style="color:#104d93" href="/service_{{ $service->id }}">{{ $translator->translate($service->Designations) }}</a>
                                </div>
                            </div>
                            @endif
                            @empty
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Translate the no articles message --}}
                                    @php
                                    $noArticlesMessage = $translator->translate('Aucun article disponible dans cette catégorie.');
                                    @endphp
                                    <p>{{ $noArticlesMessage }}</p>
                                </div>
                            </div>
                            @endforelse
                        </ul>
                    </li>
                    <li class="dropdown d-none d-sm-block" id="hover-dropdown5">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ $translator->translate('BUNGALOWS') }} </a>
                        <ul class="dropdown-menu">
                            <!-- List your categories here -->
                            <!-- LA COLINA LOUNGE et  CLUB - BUNGALOWS -->
                            @forelse($Service as $service)
                            @if ($service->categories === 'BUNGALOWS')
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Automatically detect source language and translate the category name --}}
                                   
                                    <a style="color:#104d93" href="/service_{{ $service->id }}">{{ $translator->translate($service->Designations) }}</a>
                                </div>
                            </div>
                            @endif
                            @empty
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Translate the no articles message --}}
                                    @php
                                    $noArticlesMessage = $translator->translate('Aucun article disponible dans cette catégorie.');
                                    @endphp
                                    <p>{{ $noArticlesMessage }}</p>
                                </div>
                            </div>
                            @endforelse
                        </ul>
                    </li>
                    <li class="dropdown d-none d-sm-block" id="hover-dropdown6">

                        @if($currentLocale === 'ar')
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ $translator->translate('LA COLINA LOUNGE & CLUB') }} </a>

                        @else

                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            LA COLINA LOUNGE & CLUB </a>

                        @endif


                        <ul class="dropdown-menu">
                            <!-- List your categories here -->
                            <!-- LA COLINA LOUNGE et  CLUB - BUNGALOWS -->
                            @forelse($Service as $service)
                            @if ($service->categories === 'LA COLINA LOUNGE et CLUB')
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Automatically detect source language and translate the category name --}}
                                   
                                    <a style="color:#104d93" href="/service_{{ $service->id }}">{{ $translator->translate($service->Designations) }}</a>
                                </div>
                            </div>
                            @endif
                            @empty
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Translate the no articles message --}}
                                    @php
                                    $noArticlesMessage = $translator->translate('Aucun article disponible dans cette catégorie.');
                                    @endphp
                                    <p>{{ $noArticlesMessage }}</p>
                                </div>
                            </div>
                            @endforelse
                        </ul>
                    </li>
                    <li class="dropdown d-none d-sm-block" id="hover-dropdown7">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ $translator->translate('VOS ÉVÉNEMENTS') }} </a>
                        <ul class="dropdown-menu">
                            <!-- List your categories here -->
                            <!-- LA COLINA LOUNGE et  CLUB - BUNGALOWS -->
                            @forelse($Service as $service)
                            @if ($service->categories === 'VOS ÉVÉNEMENTS')
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Automatically detect source language and translate the category name --}}
                                   
                                    <a style="color:#104d93" href="/service_{{ $service->id }}">{{ $translator->translate($service->Designations) }}</a>
                                </div>
                            </div>
                            @endif
                            @empty
                            <div class="shop-cart">
                                <div class="product-text">
                                    {{-- Translate the no articles message --}}
                                    @php
                                    $noArticlesMessage = $translator->translate('Aucun article disponible dans cette catégorie.');
                                    @endphp
                                    <p>{{ $noArticlesMessage }}</p>
                                </div>
                            </div>
                            @endforelse
                        </ul>
                    </li>
                    <li><a class="scroll-link" href="/home#contact"> {{ $translator->translate('Contact') }} </a></li>
                    <li class="dropdown d-none d-sm-block" id="hover-dropdown8">
                        @guest
                        @if (Route::has('login'))
                        <a href="login" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                            <i class="icofont icofont-user"></i>
                        </a>
                        @endif
                        @else
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            @if (Auth::user()->image)
                            <img src="/storage/{{ Auth::user()->image }}" alt="User Image" height="25px" width="25px" alt="" class="mr-2" style="border-radius: 50%;">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=104d93&color=fff" height="25px" width="25px" alt="" class="mr-2" style="border-radius: 50%;">
                            @endif

                            {{ head(explode(' ', Auth::user()->name)) }} 
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <div class="shop-cart">
                                    <div class="product-text">
                                        <a style="color:#104d93" href="" data-bs-toggle="modal" data-bs-target="#updateProfileModal">{{ $translator->translate('modifier compte') }}</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="shop-cart">
                                    <div class="product-text">
                                        <a style="color:#104d93" href="#" data-bs-toggle="modal" data-bs-target="#passwordModal"> {{ $translator->translate('Changer mot de passe') }} </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="shop-cart">
                                    <div class="product-text">
                                        <a style="color:#104d93" href="/mes_reservation"> {{ $translator->translate('Mes réservations') }} </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="shop-cart">
                                    <div class="product-text">
                                        <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:#104d93" href="#contact"> {{ $translator->translate('Déconnexion') }} </a>
                                    </div>
                                    <form id="logout-form" action="/logout" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    @endguest
                    </li>

                    @guest
                    @else

                    <li class="dropdown d-none d-sm-block" id="hover-dropdown9">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="icofont icofont-shopping-cart"></i>
                            <span class="number" id="countPanier">{{$panierCount}}</span>
                        </a>
                        <ul class="dropdown-menu scrollable-menu" id="panier">
                            @forelse ($cartItems as $item)
                            <li>
                                <div class="shop-cart">
                                    <div class="product_img">
                                        <a href="#"><img src="/storage/{{ $item->service->image }}" alt="" /></a>
                                    </div>
                                    <div class="product-text">
                                        <span class="title">{{ $item->service->Designations }}</span>
                                        <span class="quantity">Quantity: {{ $item->nombre_de_place }} <span>{{
                                            $item->service->prix }} TND</span></span>
                                    </div>
                                    <form action="/delete-panier-item/{{$item->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete-button">
                                            <i class="icofont icofont-close"></i>
                                        </button>
                                    </form>

                                </div>
                            </li>
                            @empty
                            <li class="empty-cart-message">Votre panier est vide..</li>
                            @endforelse
                            @if (count($cartItems) > 0)
                            <li>
                                <div class="shop-cart-checkout">
                                    <div class="shop-cart-text">
                                        <p>Subtotal :</p>
                                        <span>{{ $subtotal }} TND</span>
                                    </div>
                                    <a href="/front-pages/checkout">Paiment</a>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </li>
                    <li style="margin-right: 2px;"></li>





                    <li class="dropdown d-none d-sm-block" id="hover-dropdown10">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="notifications-button">
                            <i class="icofont icofont-notification" id="mark-all-read-button"></i>
                            <span class="number" id="notification-count">0</span>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end py-0">
                            <li class="dropdown-menu-header border-bottom">
                                <div class="dropdown-header d-flex align-items-center py-3">
                                    <h5 class="text-body mb-0 me-auto">Notification</h5>
                                    <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
                                </div>
                            </li>
                            <li class="dropdown-notifications-list scrollable-container" style="max-height: 300px;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item" id="notifications-list">

                                    </li>

                                </ul>
                            </li>

                        </ul>
                    </li>
                    @endguest



                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

    <!-- Start Navbar -->
    <style>
        .empty-cart-message {
            font-weight: bold;
            color: #999;
            /* Change the color to your preference */
            padding: 10px;
            text-align: center;
            background-color: #f0f0f0;
            /* Change the background color to your preference */
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 5px;
        }
    </style>
    <!-- End Navbar -->

    <!-- Start page header -->
    <section class="page-header-section" style="margin-top: 140px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1> {{ $translator->translate('Paiment') }}
                        <h1>
                </div>

                <div class="col-md-6">
                    <ul class="header-breadcrumb">
                        <li><a href="index.html"> {{ $translator->translate('Accueil') }} </a></li>
                        <li>/</li>
                        <li class="active">{{ $translator->translate('Paiment') }}
                        <li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End page header -->
    <!-- laravel style -->
    <script src="/assets/vendor/js/helpers.js"></script>
    <!-- beautify ignore:start -->
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="/assets/vendor/fonts/tabler-icons.css" />
<link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css" />
<link rel="stylesheet" href="/assets/vendor/fonts/flag-icons.css" />
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="/assets/js/config.js"></script>



<style>



   .bs-stepper .step.crossed .step-trigger .bs-stepper-icon svg{
      fill: #27347f !important;
    }
    .bs-stepper .step.active .bs-stepper-icon svg{
      fill: #27347f !important;

    }
    .bs-stepper .step.active .bs-stepper-icon i, .bs-stepper .step.active .bs-stepper-label{
      color: #27347f !important;
    }
</style>
<center>
  @if (session('success'))
  <div class="alert alert-success" role="alert">
    {{session('success')}}
  </div>
  @endif
</center>

<center>
  @if (session('Panier'))
  <div class="alert alert-danger" role="alert">
    {{session('Panier')}}
  </div>
  @endif
</center>
@if(session('selectedItems') && session('reservationId'))
    <div>
        <h2>Réservation ID: {{ session('reservationId') }}</h2>
        <h3>Selected Items:</h3>
        <ul>
            @foreach(session('selectedItems') as $item)
                <li>{{ $item['service_name'] }} - {{ $item['prix'] }}</li>
            @endforeach
        </ul>
    </div>
@endif

<center>
  @if (session('error'))
  <div class="custom-alert">
    {{ session('error') }}
  </div>
  @endif
</center>

<style>
  .custom-alert {
    background-color: #f8d7da;
    color: #721c24;
    padding: 1rem;
    border: 1px solid #f5c6cb;
    border-radius: 0.25rem;
    margin-bottom: 1rem;
  }
</style>

<section class="section-py bg-body first-section-pt" >
  <div class="container">
<div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mb-5" style="box-shadow: 0 0.25rem 1.125rem rgba(75, 70, 92, 0.1);">
  <div class="bs-stepper-header m-auto border-0 py-4">
    <div class="step" data-target="#checkout-cart">
      <button type="button" class="step-trigger" @if ($cartItems->isEmpty() || session('success'))
        style="display: none;"
    @endif
    @if ($cartItems->isEmpty())
        disabled
    @endif>
        <span class="bs-stepper-icon">
          <svg viewBox="0 0 58 54">
            <use xlink:href="/assets/svg/icons/wizard-checkout-cart.svg#wizardCart"></use>
          </svg>
        </span>
        <span class="bs-stepper-label">   {{ $translator->translate('Panier') }}  </span>
      </button>
    </div>
    <div class="line">
      <i class="ti ti-chevron-right" @if ($cartItems->isEmpty() || session('success')) style="display: none;" @endif ></i>
    </div>
    <div class="step" data-target="#checkout-payment" @if ($cartItems->isEmpty() || session('success')) style="display: none;" @endif >
      <button type="button" class="step-trigger">
        <span class="bs-stepper-icon">
          <svg viewBox="0 0 58 54">
            <use xlink:href="/assets/svg/icons/wizard-checkout-payment.svg#wizardPayment"></use>
          </svg>
        </span>
        <span class="bs-stepper-label">  {{ $translator->translate('Paiement') }}   </span>
      </button>
    </div>
    <div class="line">
      <i class="ti ti-chevron-right"   @if ($cartItems->isEmpty() || session('success') || session('error'))
        style="display: none;"
    @endif
    @if ($cartItems->isEmpty())
    style="display: none;"
    @endif></i>
    
    </div>
    <style>
 #checkout-confirmation {
    @if (session('success') && $cartItems->isEmpty())
        display: block;
    @else
        display: none;
    @endif
}

</style>

    <div class="step" data-target="#checkout-confirmation"
    @if (session('success'))
        style="display: block;"
    @elseif ($cartItems->isEmpty() || session('error'))
        style="display: none;"
    @endif
>
      <button type="button" class="step-trigger">
        <span class="bs-stepper-icon">
          <svg viewBox="0 0 58 54">
            <use xlink:href="/assets/svg/icons/wizard-checkout-confirmation.svg#wizardConfirm"></use>
          </svg>
        </span>
        <span class="bs-stepper-label">   {{ $translator->translate('Confirmation') }}  </span>
      </button>
    </div>
  </div>
  <div class="bs-stepper-content border-top">
<form id="wizard-checkout-form" onSubmit="return false">

      <!-- Cart -->
<div id="checkout-cart"  class="content" @if ( session('success')) style="display: none;" @endif >
        <div class="row">
          <!-- Cart left -->
          <div class="col-xl-8 mb-3 mb-xl-0">

            <!-- Offer alert -->

            <?php
            function formatTimeRangeWithDate($start, $end)
            {
                $startTime = new DateTime($start);
                $endTime = new DateTime($end);

                $formattedDate = $startTime->format('M d, Y');
                $formattedStartTime = $startTime->format('h:i A');
                $formattedEndTime = $endTime->format('h:i A');

                return $formattedDate . ', ' . $formattedStartTime . ' - ' . $formattedEndTime;
            }
            ?>


            <!-- Shopping bag -->
            <h5 id="panier-count"  >   {{ $translator->translate('Mon panier') }}    (<span class="number" id="countPanier1">{{$panierCount}}</span>  {{ $translator->translate('Services') }} )</h5>
            @forelse ($cartItems as $item)   
<ul class="list-group mb-3" id="panier">


<li class="list-group-item p-4 " id="cartItem{{ $item->id }}">

   
        <div class="d-flex gap-3">
            <div class="flex-shrink-0 d-flex align-items-center">
                <img src="/storage/{{$item->service->image}}" height="100px" width="100px" alt="google home" class="w-px-50">
            </div>
            <div class="flex-grow-1">
                <div class="row">
                    <div class="col-md-8">
                        <p class="me-3"><a href="javascript:void(0)" class="text-body">  {{ $translator->translate($item->service->Designations) }}   </a></p>
                        <p class="me-3"><a href="javascript:void(0)" class="text-body">{{ formatTimeRangeWithDate($item->start, $item->end) }}</a></p>



                        @if($item->service->promotion == 0)
    @if($item->service->methode_tarification == 'par_place')
    
        <input type="number" class="form-control " style="width: 17%;" data-item-id="{{ $item->id }}" data-promotion="false" value="{{ $item->nombre_de_place }}" min="1">
    @else
        <!-- Handle other methods if needed -->
    @endif
@else
<style>
    
    input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
 opacity: 1 !important;
 margin: 0;
 width: 15px;
 height: 35px;
}
    .form-group [type="number"].form-control {
    width: 60px; /* Set your default width for larger screens */
}

/* Media query for screens less than 400 pixels wide */
@media screen and (max-width: 400px) {
    .form-group [type="number"].form-control {
        width: 60px; /* Set the width to 40% for screens less than 400 pixels wide */
    }

}
</style>
<div class="form-group" data-promotion="true">
    <label for="adultsInput{{ $item->id }}">Nombre d'adultes :</label>
    <input type="number" class="form-control" data-item-id="{{ $item->id }}" value="{{ $item->nombre_de_placeAdults }}" min="1" placeholder="0" id="adultsInput{{ $item->id }}" >
</div>

<div class="form-group" data-promotion="true">
    <label for="childrenInput{{ $item->id }}">Nombre d'enfants :</label>
    <input type="number" class="form-control" data-item-id="{{ $item->id }}" value="{{ $item->nombre_de_placeChildren }}" min="0" placeholder="0" id="childrenInput{{ $item->id }}">
</div>
@endif
                    </div>
                    <div class="col-md-4">
                        <div class="text-md-end">
                            <form action="/delete-panier-item/{{$item->id}}" method="post"  >

                                @csrf
                                @method('delete')
                                <button   style="display: none;" type="submit" class="delete-button">
                                    <i  style="display: none;" class="icofont icofont-close"></i>
                                </button>
                            </form>
                           
                            <div class="my-2 my-md-4 mb-md-5"><span class="text-primary">{{ $item->service->prix }} TND</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
@empty
    <li class="empty-cart-message">
    {{ $translator->translate(' Votre panier est vide.') }}    <a href="/home">  {{ $translator->translate('Commencez à réserver maintenant') }} </a>
    </li>
@endforelse



            </ul>

            <!-- Wishlist -->

          </div>

          <!-- Cart right -->
          <div class="col-xl-4" >
            <div class="border rounded p-4 mb-3 pb-3">

              <!-- Offer -->

              <!-- <div class="row g-3 mb-3">
                <div class="col-8 col-xxl-8 col-xl-12">
                  <input type="text" class="form-control" placeholder="Enter Promo Code" aria-label="Enter Promo Code">
                </div>
                <div class="col-4 col-xxl-4 col-xl-12">
                  <div class="d-grid">
                    <button type="button" class="btn btn-label-primary">Apply</button>
                  </div>
                </div>
              </div> -->

              <!-- Gift wrap -->



              <!-- Price Details -->
  <dl class="row mb-0">
    @forelse ($cartItems as $item)
  
    <dt class="col-md-6 col-12 text-heading">  {{ $translator->translate($item->service->Designations) }}  </dt>
    <dd class="col-md-4 col-6 fw-medium text-heading mb-0" >
    <span id="quantity-{{ $item->id }}">{{ $item->nombre_de_place }}</span> * {{ $item->service->prix }} TND
    </dd>
  
    <dd class="col-md-2 col-6 text-end mb-0">
    <form action="/delete-panier-item/{{$item->id}}" method="post" >
    @csrf
    @method('delete')
    <button type="submit" class="delete-button">
    <i class="icofont icofont-close"></i></button>
    </form>
</dd>
    @empty
    <li >   {{ $translator->translate('Votre panier est vide.') }}  </li>
    @endforelse
</dl>

           
              <hr class="mx-n4">
              <dl class="row mb-0" id="dynamicContentContainer">
@if ($totalWithoutPromotion == $subtotal )



<dt class="col-6 text-heading">Total</dt>
<dd class="col-6 fw-medium text-end text-heading mb-0">
    <span id="subtotal">{{ $subtotal }}TND</span>
    <i class="fas fa-gift" style="color: #FF0000;"></i> <!-- Utilisez une icône de cadeau pour la promotion -->
</dd>



@else



<dt class="col-6 text-heading">Total sans Promotion</dt>
<dd class="col-6 fw-medium text-end text-heading mb-0">
    
    <span id="totalwithoutPromotion">{{ $totalWithoutPromotion }}TND</span>
    <i class="fas fa-tag" style="color: #FFD700;"></i> <!-- Utilisez une icône de tag pour la non-promotion -->
</dd>

<dt class="col-6 text-heading">Total avec Promotion</dt>
<dd class="col-6 fw-medium text-end text-heading mb-0">
    <span id="subtotal">{{ $subtotal }}TND</span>
    <i class="fas fa-gift" style="color: #FF0000;"></i> <!-- Utilisez une icône de cadeau pour la promotion -->
</dd>



@endif
             


              </dl>
            </div>
            <div class="d-grid">
              
              <div class="step"  data-target="#checkout-payment">
      <button type="button" style="background-color:#104d93;"   class="step-trigger btn btn-primary" @if ($cartItems->isEmpty()) disabled @endif>
       
        <span class="bs-stepper-label" style="color: white;" >   {{ $translator->translate('Confirmer ma reservation') }}  </span>

</span>
      </button>
    </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Address -->
    
      @php
      $configData = Helper::appClasses();
      @endphp
      <!-- Payment -->
      <div id="checkout-payment" class="content" @if ($cartItems->isEmpty()) style="display: none;" @endif>
        
          <div class="container mt-2">
            <div class="card px-3">
              <div class="row">
                <div class="col-lg-7 card-body border-end">
                  <h4 class="mb-2">Checkout</h4>
                  <p class="mb-0">All plans include 40+ advanced tools and features to boost your product. <br>
                    Choose the best plan to fit your needs.</p>
                  <div class="row py-4 my-2">
                  <div class="col-md mb-md-0 mb-2">
    <div class="form-check custom-option custom-option-basic checked">
        <label class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center" for="customRadioVisa">
            <input name="customRadioTemp" class="form-check-input" type="radio" value="credit-card" id="customRadioVisa" checked />
            <span class="custom-option-body">
                <img src="/assets/img/icons/payments/visa-light.png" alt="visa-card" width="58" data-app-light-img="icons/payments/visa-light.png" data-app-dark-img="icons/payments/visa-dark.png">
                <span class="ms-3">    {{ $translator->translate('En ligne') }}   </span>
            </span>
        </label>
    </div>
</div>
<div class="col-md mb-md-0 mb-2">
    <div class="form-check custom-option custom-option-basic">
        <label class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center" for="customRadioPaypal">
            <input name="customRadioTemp" class="form-check-input" type="radio" value="paypal" id="customRadioPaypal" />
            <span class="custom-option-body">
                <img src="/espece.png" alt="paypal" width="58" data-app-light-img="icons/payments/paypal-light.png" data-app-dark-img="icons/payments/paypal-dark.png">
                <span class="ms-3">  {{ $translator->translate('En espèce') }}</span>
            </span>
        </label>
    </div>
</div>
                  </div>
                  <h4 class="mt-2 mb-4">  {{ $translator->translate('Détails de la facturation') }}  </h4>
                 

                  <form>
                    <div class="row g-3">
                      <div class="col-md-6">
                      <input type="hidden" id="User-id" class="form-control" value="{{Auth::user()->id}}" readonly/>

                        <label class="form-label" for="billings-email">  {{ $translator->translate('Email Address') }}  </label>
                        <input type="text" class="form-control" value="{{Auth::user()->email}}" readonly/>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="billings-password">  {{ $translator->translate('Nom') }}   </label>
                        <input id="nom" type="text"  class="form-control" value="{{Auth::user()->name}}" />
                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="billings-password"> {{ $translator->translate('téléphone') }}   </label>
                      <br>
                        <input  id="phone" value="{{ Auth::user()->numero}}" type="tel" class="form-control" name="numero" required="" />

                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="billings-country"> {{ $translator->translate('Pays') }} </label>
                        <select id="pays" name="pays"  class="form-control mb-1" required>
                                @foreach ($countries as $countryCode => $countryName)
                                <option value="{{ $countryCode }}" @if (Auth::user()->pays === $countryCode) selected @endif>{{ $countryName }}</option>
                                @endforeach
                            </select>

                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="billings-zip">  {{ $translator->translate('genre') }}  </label>
                        <select name="genre" id="genre" class="form-control mb-1" required>
                                <option value="Femme" @if (Auth::user()->genre === 'Femme') selected @endif>Femme</option>
                                <option value="Homme" @if (Auth::user()->genre === 'Homme') selected @endif>Homme</option>
                            </select>
                      </div>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-6">

                    </div>
                    
                  </form>
                  <script>
    $(document).ready(function () {
        $('#update-profile-button').on('click', function () {
            var name = $('#nom').val();
            var numero = $('#phone').val();
            var pays = $('#pays').val();
            var genre = $('#genre').val();
            var idUser = $('#User-id').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            // Update the keys here to match the controller
            $.ajax({
                type: 'POST',
                url: '/updateProfilecheckout',
                data: {
                    name: name,
                    numero: numero,
                    pays: pays,
                    genre: genre,
                    idUser: idUser
                },
                success: function (data) {
                    // Handle the success response, e.g., show a toast message
                    // toastr.success(data.message);
                },
                error: function (error) {
                    // Handle errors and display a toast message for errors
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    });
</script>



                

                </div>
                <div class="col-lg-5 card-body">
                  <h4 class="mb-2">    {{ $translator->translate('Récapitulatif de la commande') }}  </h4>
                
                
                  <div>
                 
                    
                   
                    <div class="d-flex justify-content-between align-items-center mt-3 pb-1">
                      <p class="mb-0">    {{ $translator->translate('Total') }}  </p>
                   


                      
                      <dd class="col-6 fw-medium text-end text-heading mb-0" id="subtotalCommande" >{{ $subtotal }}TND</dd>

                    </div>
                   
                    <div class="step" data-target="#checkout-confirmation">
    <button type="button" style="background-color:#104d93; color:white" class="step-trigger" id="confirm-reservation-button" @if ($cartItems->isEmpty()) disabled @endif>
        <span class="bs-stepper-icon">
            <svg viewBox="0 0 58 54">
                <use xlink:href="/assets/svg/icons/wizard-checkout-confirmation.svg#wizardConfirm"></use>
            </svg>
        </span>
        <span type="button" class="bs-stepper-label"   id="update-profile-button">    {{ $translator->translate('Confirmation') }}  </span>



    </button>
   
</div>
    </div>


    <style>/* Add this to your stylesheet */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    /* Semi-transparent white background */
    z-index: 9999;
    /* Ensure the overlay appears on top of other elements */
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
    border: 33px solid #3498db;
    /* Change the color to your preference */
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
}</style><div id="overlay" class="overlay"><div id="your-spinner-id" class="lds-ripple"><div></div><div></div></div></div>

<script>
    
function showSpinner() { // Show the overlay with the spinner
    document.getElementById('overlay').style.display = 'flex';

}

function hideSpinner() { // Hide the overlay
    document.getElementById('overlay').style.display = 'none';
}
    $(document).ready(function () {
        var paiementButton = $('#checkout-payment button.step-trigger');
        var checkoutPayment = $('#checkout-payment');

        var checkoutCart = $('#checkout-cart');
        $('#confirm-reservation-button').on('click', function () {
            showSpinner();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        

            var selectedPaymentMethod = $('input[name="customRadioTemp"]:checked').val();

if (selectedPaymentMethod === 'credit-card') {

    var name = $('#nom').val();
        var numero = $('#phone').val();
        var pays = $('#pays').val();
        var genre = $('#genre').val();
        var idUser = $('#User-id').val();

        $.ajax({
            type: 'POST',
            url: '/updateProfilecheckout',
            data: {
                name: name,
                numero: numero,
                pays: pays,
                genre: genre,
                idUser: idUser
            },
            success: function (data) {
                // Handle the success response, e.g., show a toast message
                // toastr.success(data.message);
            },
            error: function (error) {
                // Handle errors and display a toast message for errors
                toastr.error(error.responseJSON.message);
            }
        });
    var subtotalText = $('#subtotalCommande').text();
    var subtotalValue = parseFloat(subtotalText);
    if (!isNaN(subtotalValue)) {
    // Calculate amountInTND
    var amountInTND = subtotalValue * 1000;

    // Redirect to the desired URL
    window.location.href = '/Testpayment/' + amountInTND;
    
    return;
} else {
    // Handle the case where the extracted value is not a valid number
    
    toastr.error('Invalid subtotal value:', subtotalText);
    // You may want to display an error message or handle it in an appropriate way
    return;
}

}



        

            $.ajax({
                type: 'POST',
                url: '/confirm-reservation',
                data: {
            selectedPaymentMethod: selectedPaymentMethod
        },
        complete: function (xhr) {
        if (xhr.status == 419) {
            // CSRF token mismatch, reload the page
            location.reload();
        }
    },
                success: function (data) {
                    hideSpinner(); // Call this function in the success callback

                    // Handle success (e.g., show a toast message)
                    toastr.success(data.message);
                    $('.custom-alert').remove();
                   

// Display the checkout confirmation step
$('#checkout-confirmation').css('display', 'block');
$('.step').css('display', 'block');


                    var panierDropdown = $('#panier');
        panierDropdown.empty(); // Clear the cart dropdown content
        panierDropdown.append('<li class="empty-cart-message">Votre panier est vide..</li>');

        // Optionally, you can hide the cart icon or perform any other action
        // Here's an example of hiding the cart icon
        $('#countPanier').text('0'); // Hide the cart icon text/number
        paiementButton.prop('disabled', true);
        checkoutPayment.css('display', 'none');
        checkoutCart.css('display', 'none');


                    $('#panier-count').text(data.panierCount);
                    var selectedItems = data.selectedItems;
                    
                 


    // Do something with selectedItems in your JavaScript
    var reservationId = data.reservationId;
   
    $('#reservation-id').html('Votre commande  N <a href="javascript:void(0)">' + data.reservationId + '</a> a été placé!');
    var selectedItemsList = $('#selected-items-list');
                    selectedItemsList.empty(); // Clear previous content

                   if (data.selectedItems.length > 0) {
    // Loop through selected items and add them to the list
    $.each(data.selectedItems, function (index, item) {
        var listItem = `
            <li class="list-group-item flex-fill p-4 text-heading">
                <div class="d-flex gap-3">
                    <div class="flex-shrink-0 d-flex align-items-center">
                        <img src="${item.image}" height="100px" width="100px" alt="Service Image" class="w-px-50">
                    </div>
                    <div class="flex-grow-1">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="me-3">
                                    <a href="javascript:void(0)" class="text-body">${item.service_name}</a>
                                </p>
                                <p class="me-3">
                                    <a href="javascript:void(0)" class="text-body">${formatTimeRangeWithDate(item.start, item.end)}</a>
                                </p>
                                <!-- Add input, delete form, and price as needed -->
                            </div>
                            <!-- Add the rest of your HTML structure here -->
                        </div>
                    </div>
                </div>
            </li>
        `;
        selectedItemsList.append(listItem);
    });
} else {
    // Handle the case where there are no selected items
    selectedItemsList.append('<li class="empty-cart-message">No selected items</li>');
}

                },
                error: function (error) {
                    // Handle errors and show a toast message
                    toastr.error(error.responseJSON.message);
                }
            });
        });

        
    });
</script>        
<script>
function formatTimeRangeWithDate(start, end) {
    var startTime = new Date(start);
    var endTime = new Date(end);
    
    var formattedDate = startTime.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    var formattedStartTime = startTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
    var formattedEndTime = endTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
    
    return formattedDate + ', ' + formattedStartTime + ' - ' + formattedEndTime;
}

  
</script>
                    <p class="mt-4 pt-2">By continuing, you accept to our Terms of Services and Privacy Policy. Please note that payments are non-refundable.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
       
      </div>

      <!-- Confirmation -->
      <div id="checkout-confirmation" class="content">
        <div class="row mb-3">
          <div class="col-12 col-lg-8 mx-auto text-center mb-3">
            <h4 class="mt-2">   {{ $translator->translate(' Merci!') }}    😇</h4>


            
            <p id="reservation-id">
    @isset(request()->reservationId)
    {{ $translator->translate('  Votre commande') }}     <a href="#"> {{ $translator->translate(' ici') }}    ici</a> {{ $translator->translate(' avec l\'ID de réservation :') }}    {{ request()->reservationId }} {{ $translator->translate('  a été placée !') }}  
    @else
    {{ $translator->translate('  Your order ') }}        <a href="#">   {{ $translator->translate(' in her ') }}      </a>   {{ $translator->translate(' has been placed!') }}  
    @endisset
</p>


            <p> {{ $translator->translate('Nous avons envoyé un email à') }}   <a href="mailto:{{auth()->user()->email}}">{{auth()->user()->email}}</a>  {{ $translator->translate('votre confirmation de commande et votre reçu. Si l\'e-mail n\'est pas arrivé dans les deux minutes, veuillez vérifier votre dossier spam pour voir si l\'e-mail y a été acheminé') }}  </p>
          </div>
          <!-- Confirmation details -->
          <div class="col-12">
            <ul class="list-group list-group-horizontal-md">
            <li class="list-group-item flex-fill p-4 text-heading">
    <h6 class="d-flex align-items-center gap-1"><i class="ti ti-user"></i>  {{ $translator->translate('Informations personnelle') }} </h6>
    <address id="user-address" class="mb-0">
        {{ auth()->user()->name }} <br />
        {{ auth()->user()->email }} <br />
        {{ auth()->user()->pays }}
    </address>
    <p id="user-phone" class="mb-0 mt-3">
        {{ auth()->user()->numero }}
    </p>
</li>
<li class="list-group-item flex-fill p-4 text-heading">
 <h6 class="d-flex align-items-center gap-1"><i class="ti ti-bag"></i> {{ $translator->translate('Détails du commande') }}   </h6>
               
                <dl  id="selected-items-list"class="row mb-0">
                </dl>
               
            
                <dl  class="row mb-0">
                @isset(request()->selectedItems)
    <dl id="selectedItemsList" class="row mb-0">
        @forelse(request()->selectedItems as $item)
            <li class="list-group-item flex-fill p-4 text-heading">
                <div class="d-flex gap-3">
                    <div class="flex-shrink-0 d-flex align-items-center">
                        <img src="{{ $item['image'] }}" height="100px" width="100px" alt="Service Image" class="w-px-50">
                    </div>
                    <div class="flex-grow-1">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="me-3">
                                    <a href="javascript:void(0)" class="text-body">{{ $item['service_name'] }}</a>
                                </p>
                                <p class="me-3">
                                    <a href="javascript:void(0)" class="text-body">{{ formatTimeRangeWithDate($item['start'], $item['end']) }}</a>
                                </p>
                                <!-- Add input, delete form, and price as needed -->
                            </div>
                            <!-- Add the rest of your HTML structure here -->
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <p>No items available.</p>
        @endforelse
    </dl>
@endisset

</dl>





</li>
<li class="list-group-item flex-fill p-4 text-heading">
              <h6 class="d-flex align-items-center gap-1"><i class="ti ti-credit-card"></i> {{ $translator->translate('Détails du paiement') }}  </h6>



              
              @if (isset(request()->selectedItems) && count(request()->selectedItems) > 0)
    <dl id="selectedItemsList" class="row mb-0">
        @forelse(request()->selectedItems as $item)
            <div class="col-md-6 col-12 text-heading">{{ $item['service_name'] }}</div>
            <div class="col-md-4 col-6 fw-medium text-heading mb-0">
                <span id="Détailsdupaiement-{{ $item['id'] }}">{{ $item['nombre_de_place'] }}</span> * {{ $item['prix'] }} 
            </div>
        @empty
            <p>No items available.</p>
        @endforelse
    </dl>
@else
    <dl class="row mb-0">
        @forelse ($cartItems as $item)
            <dt class="col-md-6 col-12 text-heading">{{ $item->service->Designations }}</dt>
            <dd class="col-md-4 col-6 fw-medium text-heading mb-0">
                <span id="Détailsdupaiement-{{ $item->id }}">{{ $item->nombre_de_place }}</span> * {{ $item->service->prix }} TND
            </dd>
        @empty
            <li class="empty-cart-message">Votre panier est vide..</li>
        @endforelse
    </dl>
@endif

 <hr class="mx-n4">
 <dl class="row mb-0">
 <dt class="col-6 text-heading">Total</dt>

<dd class="col-6 fw-medium text-end text-heading mb-0" >
    @isset(request()->selectedItems)
        @php
            $subtotal = 0;
            foreach(request()->selectedItems as $item) {
                $subtotal += $item['subtotal'];
            }
            echo $subtotal . ' TND';
            
        @endphp
    @else
    <dd id="subtotalConfiramation">{{ $subtotal }}TND</dd>

    @endisset
</dd>
</dd>
</dl>

              </li>
            </ul>
          </div>
        </div>

        <div class="row">
          <!-- Confirmation items -->
         
        <!-- List of selected items will be displayed here -->
    </div>
          <!-- Confirmation total -->
        
        </div>
      </div>
    </form>
  </div>
</div>
<!--/ Checkout Wizard -->

<style>/* Add this to your stylesheet */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    /* Semi-transparent white background */
    z-index: 9999;
    /* Ensure the overlay appears on top of other elements */
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
    border: 33px solid #3498db;
    /* Change the color to your preference */
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
}</style><div id="overlay" class="overlay"><div id="your-spinner-id" class="lds-ripple"><div></div><div></div></div></div>

<script>

function showSpinner() { // Show the overlay with the spinner
    document.getElementById('overlay').style.display = 'flex';

}

function hideSpinner() { // Hide the overlay
    document.getElementById('overlay').style.display = 'none';
}
  // Function to update cart item quantity
    function updateCartItemQuantity(itemId, newQuantity , adultsValue, childrenValue ) {


      
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        showSpinner()
        $.ajax({
        type: 'POST',
        url: '/update-cart-item-quantity', // Replace with your route
        data: {
            item_id: itemId,
            new_quantity: newQuantity,
            adultsValue : adultsValue,
            childrenValue : childrenValue
        },

        success: function(response) {
            hideSpinner() 
            // Update the UI with the updated cart data
            displayMessage('Le panier a été mis à jour avec succès.')
            
            // Example: Update the subtotal on the page
            $('#subtotal').text(response.total + 'TND'); // Concatenate 'TND' to the updated subtotal
            $('#subtotal1').text(response.total + 'TND'); // Concatenate 'TND' to the updated subtotal
            $('#totalwithoutPromotion').text(response.totalWithoutPromotion + 'TND'); // Concatenate 'TND' to the updated subtotal
   
            $('#nombre_de_place').text(response.newQuantity);
            $('#quantity-' + itemId).text(newQuantity);
            $('#quantity1-' + itemId).text(newQuantity);
            
            $('#Détailsdupaiement-' + itemId).text(newQuantity);
            

            $('#subtotalCommande').text(response.total+ 'TND');

            $('#totalwithoutPromotionCommande').text(response.totalWithoutPromotion + 'TND'); // Concatenate 'TND' to the updated subtotal

            
            $('#subtotalConfiramation').text(response.total+ 'TND');

            $('#totalwithoutPromotionConfiramation').text(response.totalWithoutPromotion + 'TND'); // Concatenate 'TND' to the updated subtotal

            $('#dynamicContentContainer').load(location.href + ' #dynamicContentContainer');

            // You can update other elements or the entire cart content as needed
        
        },
        error: function(error) {
            console.error(error);
            // displayMessageErreur(error.responseJSON.message); 
            $('#error-message-container').html('<div class="alert alert-danger" role="alert">' + error.responseJSON.message + '</div>');
    $('#myModal').modal('show');
        }
        });
    }

    // Attach change event listener to input fields
    $('input[data-item-id]').on('change', function() {
    var itemId = $(this).data('item-id');
    var adultsValue = parseInt($('#adultsInput' + itemId).val()) || 0;
    var childrenValue = parseInt($('#childrenInput' + itemId).val()) || 0;

    var hasPromotion = $(this).closest('[data-promotion]').data('promotion') === true;

    // Now 'hasPromotion' will be true if the service has promotion, and false otherwise

    if (hasPromotion == true){
        function calculateSum(item) {
    var adultsValue = parseInt($('#adultsInput' + item.id).val()) || 0;
    var childrenValue = parseInt($('#childrenInput' + item.id).val()) || 0;
    return adultsValue + childrenValue;
}
        var newQuantity = calculateSum({ id: itemId });
        updateCartItemQuantity(itemId, newQuantity ,adultsValue ,childrenValue  );
    }else{
        var newQuantity = $(this).val();
        updateCartItemQuantity(itemId, newQuantity);
    }

    // UpdateCartItemQuantity based on the 'hasPromotion' variable
   
});
    
    function displayMessage(message) {
        toastr.options = {
            closeButton: true, // Show the close button
            positionClass: 'toast-bottom-right', // Display the toast at the top and center
        };
        toastr.success(message, 'notification');
    }

    function displayMessageErreur(message) {
        toastr.options = {
            closeButton: true, // Show the close button
            positionClass: 'toast-bottom-right', // Display the toast at the top and center
        };
        toastr.error(message, 'notification');
    }
</script>
<style>
    #toast-container > .toast-success {
    background-color: green !important; /* Use !important to override any inline styles */
  }
    #toast-container > .toast-error {
    background-color: red !important; /* Use !important to override any inline styles */
}
.navbar-nav li a {
    white-space: nowrap; /* Prevent text from wrapping */
    overflow: hidden; /* Hide overflowing text */
    text-overflow: ellipsis; /* Display ellipsis (...) for overflowing text */
}

</style>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body">
        <!-- Modal content goes here -->
        <div id="error-message-container"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-dismiss="modal">Fermer</button>

        <!-- Other modal buttons if needed -->
      </div>
    </div>
  </div>
</div>



</div>
</section>
    <!-- START BLOG MAIN AREA -->
  
    <!-- END BLOG MAIN AREA -->

    <!-- Start footer top -->
    <footer class="footer-top section-bg"> 
            <div class="container"> 
                <div class="row"> 
                    <div class="col-md-3"> 
                        <div class="footer-content">
                            <a href="/home"><img src="/LOGO SITE WEBHA-01.png" height="150px" width="150px" alt="" /></a>
                            
                           
                        </div>
                    </div>
                 
                    <div class="col-md-3"> 
                        <div class="footer-content">
                        <h4>{{ $translator->translate('Heures d\'ouverture') }}</h4>
                            <ul class="open-hours"> 
                               <li>Tous les jours, de 8h00 à 20h00</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-3"> 
                    <div class="footer-content">
                            <h4> {{ $translator->translate('Contact') }}</h4>
                            <ul class="contact-list"> 
                                <li> {{ $translator->translate('Station Thermale Hammam Boulâaba') }} </li>
                                <li> {{ $translator->translate('Téléphone: +216 55 520 540') }} </li>
                                <li> {{ $translator->translate('E-mail') }}: contact@hammamboulaaba.com</a></li>
                            </ul>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3"> 

<div class="footer-content">

<ul class="social-links"> 
                                <li> 
                                    <a href="https://www.facebook.com/hammamboulaaba">   <i class="fab fa-facebook"></i>

</a>
                                </li>
                                <li> 
                                    <a href="https://www.facebook.com/hammamboulaaba"><i class="fab fa-instagram"></i>
</a>
                                </li>
                               
                            </ul>
        </div>
</div>
                    
                    
                </div>
            </div>
        </footer>
        <!-- End footer top -->
  
        <!-- Start footer bottom -->
        <footer class="footer-bottom"> 
            <div class="container"> 
                <div class="row"> 
                    <div class="col-md-12"> 
                    <p> {{ $translator->translate('Copyright 2023 all rights by') }}  <a href="https://www.e-build.tn/" target="_blank" style="color: red; border-bottom: 2px solid red;">Ebuild </a></p>
                    </div>
                </div>
            </div>
        </footer>
    <style>
        /* Reduce the padding and margins of the footer */
.footer-top {
    padding-top: 0px; /* Adjust as needed */
    padding-bottom: 0px; /* Adjust as needed */
}

.footer-bottom {
    padding: 10px 0; /* Adjust as needed */
}
.footer-content{
    margin-bottom:0px;
}
    </style>

   
    <!-- End footer top -->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel">Modifier le compte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <!-- User information update form -->
                    <form action="/update_profile" method="POST" enctype="multipart/form-data">
                        @csrf
                        @guest
                        @else
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                        <!-- Add form fields for updating user information -->
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email}}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Image</label>
                            <!-- Display user's image if it exists -->
                            @if (Auth::user()->image)
                            <img src="/storage/{{ Auth::user()->image }}" alt="User Image" height="250px" width="250px" class="img-fluid mb-2">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{urlencode(auth()->user()->name) }}&background=104d93&color=fff'" height="250px" width="250px" alt="" class="mr-2">

                            @endif
                            <!-- Input for updating the user's image -->
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="email">Telephone</label>

                            <input id="phoneProfile" value="{{ Auth::user()->numero}}" type="tel" class="form-control" name="numero" required="" />

                        </div>

                        <div class="form-group">
                            <label for="email">Pays</label>

                            <select name="pays"  id="paysProfile" class="form-control mb-1" required>
                                @foreach ($countries as $countryCode => $countryName)
                                <option value="{{ $countryCode }}" @if (Auth::user()->pays === $countryCode) selected @endif>{{ $countryName }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="email">Genre</label>
                            <select name="genre"  class="form-control mb-1" required>
                                <option value="">Select genre</option>
                                <option value="Femme" @if (Auth::user()->genre === 'Femme') selected @endif>Femme</option>
                                <option value="Homme" @if (Auth::user()->genre === 'Homme') selected @endif>Homme</option>
                            </select>
                        </div>


                        <!-- Add other form fields for pays, numero, image, genre, etc. -->

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade passwordModal" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('update_password') }}">
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

    <div class="modal fade" id="profileChanger" tabindex="-1" aria-labelledby="profileChangerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="passwordChangeSuccessModalLabel">Mot de passe modifié avec succès</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 10px;">
                    Profile modifié avec succès.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Start footer bottom -->

    <!-- End footer bottom -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/assets/vendor/libs/select2/select2.js"></script>
<script src="/assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
<script src="/assets/vendor/libs/rateyo/rateyo.js"></script>
<script src="/assets/vendor/libs/cleavejs/cleave.js"></script>
<script src="/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
<script src="/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
<script src="/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
<script src="/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
<script src="/assets/js/wizard-ex-checkout.js"></script>
    <!-- Bootstrap js file -->
    <script src="/client/{{ $currentLocale }}/assets/js/jquery.min.js"></script>

    <script src="/client/{{ $currentLocale }}/assets/js/bootstrap.min.js"></script>
    <!-- Owl.carousel js file -->
    <script src="/client/{{ $currentLocale }}/assets/js/owl.carousel.min.js"></script>
    <!-- Jquery.magnific-popup js file -->
    <script src="/client/{{ $currentLocale }}/assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Velocity min JS file -->
    <script src="/client/{{ $currentLocale }}/assets/js/velocity.min.js"></script>
    <!-- Velocity.ui min JS file -->
    <script src="/client/{{ $currentLocale }}/assets/js/velocity.ui.min.js"></script>
    <!-- Jquery-ui JS file -->
    <!-- Google recaptcha JS -->
    <!-- Active js file -->
    <script src="/client/{{ $currentLocale }}/assets/js/active.js"></script>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const phoneInputField = document.querySelector("#phone");
        const phoneInputFieldProfile = document.querySelector("#phoneProfile");

        const countryDropdown = document.querySelector("#pays");
        const countryDropdownProfile = document.querySelector("#paysProfile");

        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "tn", // Set the default country to Tunisia ("TN"),
            nationalMode: false, // Disable country-specific validation
        });

        const phoneInputProfile = window.intlTelInput(phoneInputFieldProfile, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "tn", // Set the default country to Tunisia ("TN"),
            nationalMode: false, // Disable country-specific validation
        });

        // Event listener for the main country dropdown
        countryDropdown.addEventListener("change", function() {
            // Get the selected country code from the dropdown
            const selectedCountry = this.value;

            // Update the phone input's initial country based on the selected country
            phoneInput.setCountry(selectedCountry);
        });

        // Event listener for the profile country dropdown
        countryDropdownProfile.addEventListener("change", function() {
            // Get the selected country code from the dropdown
            const selectedCountryProfile = this.value;

            // Update the profile phone input's initial country based on the selected country
            phoneInputProfile.setCountry(selectedCountryProfile);
        });
    });
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />




    <script src="/js/app.js"></script>
    <style>
                                        /* Style the delete button with the icofont icon */
                                      /* Style the delete button with the icofont icon */
.delete-notification-button {
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-size: 24px; /* Adjust the font size as needed */
    color: red; /* Customize the color */
    float: right; /* Align to the right */
}

/* Change the icon color on hover */
.delete-notification-button:hover {
    color: darkred; /* Customize the hover color */
}

/* Style the message container to contain the message and delete button */
.message-container {
    text-align: left; /* Align the message text to the left */
}

                                    </style>
 <script>
    document.addEventListener("DOMContentLoaded", function () {
        const userId = '{{ Auth::id() }}';
        const echo = window.Echo.private(`myPrivateChannel.user.${userId}`);
        const notificationsList = document.getElementById('notifications-list');
        const notificationCount = document.getElementById('notification-count');
        let countValue = parseInt(notificationCount.getAttribute('data-count')) || 0;

        // Function to add a notification to the list
        function addNotification(message, notificationId, createdAt) {
    const notificationItem = document.createElement('li');
    notificationItem.className = 'list-group-item list-group-item-action dropdown-notifications-item';
    notificationItem.setAttribute('data-notification-id', notificationId);

    const flexContainer = document.createElement('div');
    flexContainer.className = 'd-flex';

    const avatarContainer = document.createElement('div');
    avatarContainer.className = 'flex-shrink-0 me-3';

    const avatar = document.createElement('div');
    avatar.className = 'avatar';

    // Set the avatar to a static value for admin
    const adminLogo = document.createElement('img');
    adminLogo.src = '/logotitle.png'; // Set the path to the admin's logo image
    adminLogo.alt = 'Admin Logo';
    adminLogo.className = 'admin-logo';
    adminLogo.setAttribute('height', '50'); // Set the desired height in pixels
    adminLogo.setAttribute('width', '50');  // Set the desired width in pixels

    avatar.appendChild(adminLogo);

    avatarContainer.appendChild(avatar);

    const contentContainer = document.createElement('div');
    contentContainer.className = 'flex-grow-1';

    // Split the message into lines and create separate <p> elements for each line
    // Create a single <p> element for the entire message without line breaks
    const contentElement = document.createElement('p');
    contentElement.className = 'mb-0';
    contentElement.style.fontSize = '13px';
    contentElement.innerHTML = message; // Use innerHTML to parse HTML tags like <br>
    contentContainer.appendChild(contentElement);

    const link = document.createElement('a');
    link.href = '/mes_reservation';
    link.textContent = 'Voir les détails';
    link.style.fontSize = '14px'; // Set the font size to 13 pixels
    link.style.textDecoration = 'underline'; // Underline the text
    link.style.marginTop = '5px'; // Add margin for spacing
    contentContainer.appendChild(link);
    const lineBreak = document.createElement('br');
    contentContainer.appendChild(lineBreak);
    const timestampContainer = document.createElement('small');
    timestampContainer.className = 'text-muted';

    // Customize the timestamp appearance
    timestampContainer.innerHTML = '<span style="color: blue; font-size: 11px;">' + timeAgo(createdAt) + '</span>';

    contentContainer.appendChild(timestampContainer);

    const actionsContainer = document.createElement('div');
    actionsContainer.className = 'flex-shrink-0 dropdown-notifications-actions';

    const deleteButton = document.createElement('button');
    deleteButton.className = 'delete-notification-button';
    deleteButton.innerHTML = '&#10006;'; // "X" icon
    deleteButton.style.fontSize = '14px'; // Set the desired font size

    deleteButton.addEventListener('click', () => {
        deleteNotification(notificationId);
    });

    actionsContainer.appendChild(deleteButton);

    flexContainer.appendChild(avatarContainer);
    flexContainer.appendChild(contentContainer);
    flexContainer.appendChild(actionsContainer);

    notificationItem.appendChild(flexContainer);

    notificationsList.appendChild(notificationItem);

    countValue++;
    notificationCount.textContent = countValue;
    notificationCount.setAttribute('data-count', countValue);
}

function timeAgo(timestamp) {
    const now = new Date();
    const seconds = Math.floor((now - new Date(timestamp)) / 1000);

    let interval = Math.floor(seconds / 31536000);

    if (interval >= 1) {
        return "il ya " + interval + " year(s)";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval >= 1) {
        return "il ya " +  interval + " month(s) ";
    }
    interval = Math.floor(seconds / 86400);
    if (interval >= 1) {
        return  "il ya " +  interval + " day(s) ";
    }
    interval = Math.floor(seconds / 3600);
    if (interval >= 1) {
        return  "il ya " +  interval + " hour(s) ";
    }
    interval = Math.floor(seconds / 60);
    if (interval >= 1) {
        return  "il ya " +  interval + " minute(s) ";
    }
    return "il ya " +  Math.floor(seconds) + " second(s) ";
}




        function deleteNotification(notificationId) {
            fetch(`/delete-notification/${notificationId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const deletedNotification = document.querySelector(`[data-notification-id="${notificationId}"]`);
                        if (deletedNotification) {
                            deletedNotification.remove();
                            if (countValue > 0) {
                                countValue--; // Decrease the count only if it's greater than 0
                            }
                            notificationCount.textContent = countValue;
                            notificationCount.setAttribute('data-count', countValue);
                            displayMessage('La notification a été supprimée avec succès.');
                            checkAndDisplayNoNotifications();
                        }
                    }
                })
                .catch(error => {
                    console.error('Error deleting notification:', error);
                    displayMessageErreur(error);
                });
        }


        function fetchDatabaseNotificationsAndDisplay() {
            fetch('/fetch-database-notifications')
                .then(response => response.json())
                .then(data => {
                    const notifications = data.notifications;
                    const unreadCount = data.unreadCount;
                    const notificationIds = data.notificationIds;

                    notificationsList.innerHTML = ''; // Clear existing notifications

                    notifications.forEach((notification, index) => {
                        addNotification(notification.message, notificationIds[index], notification.created_at);
                    });

                    countValue = unreadCount;
                    notificationCount.textContent = countValue;
                    notificationCount.setAttribute('data-count', countValue);

                    checkAndDisplayNoNotifications();
                })
                .catch(error => {
                    if (error instanceof SyntaxError) {
                        console.error('Error fetching database notifications: Invalid JSON response');
                    } else {
                        console.error('Error fetching database notifications:', error);
                        // You can also display a user-friendly error message to the page
                        // for the user to see, depending on your application's requirements.
                        // For example:
                        // const errorDiv = document.getElementById('error-message');
                        // errorDiv.textContent = 'An error occurred while fetching notifications';
                    }
                });
        }

        fetchDatabaseNotificationsAndDisplay();

        echo.listen('.App\\Events\\PrivateChannelUser', (e) => {
    if (e.message && e.created_at) {
        addNotification(e.message, e.created_at);
        checkAndDisplayNoNotifications();
    }
});

        function markAllNotificationsRead() {
            fetch('/mark-all-notifications-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    fetchDatabaseNotificationsAndDisplay();
                })
                .catch(error => {
                    console.error('Error marking all notifications as read:', error);
                });
        }

        const markAllReadButton = document.getElementById('mark-all-read-button');
        markAllReadButton.addEventListener('click', markAllNotificationsRead);

        function checkAndDisplayNoNotifications() {
            const noNotificationsMessage = document.querySelector('.empty-notifications-message');

            if (notificationsList.children.length === 0) {
                if (!noNotificationsMessage) {
                    const newNoNotificationsMessage = document.createElement('li');
                    newNoNotificationsMessage.textContent = 'Pas de notifications disponibles';
                    newNoNotificationsMessage.className = 'empty-notifications-message';
                    notificationsList.appendChild(newNoNotificationsMessage);
                }
            } else {
                if (noNotificationsMessage) {
                    notificationsList.removeChild(noNotificationsMessage);
                }
            }
        }
        function displayMessage(message) {
    toastr.options = {
        closeButton: true, // Show the close button
        positionClass: 'toast-bottom-right', // Display the toast at the top and center
    };
    toastr.success(message, 'notification');
}

function displayMessageErreur(message) {
    toastr.options = {
        closeButton: true, // Show the close button
        positionClass: 'toast-bottom-right', // Display the toast at the top and center
    };
    toastr.error(message, 'notification');
}
    });

</script>

<!-- Add this style block in your HTML's head or link to an external CSS file -->
<style>
    .notification-item {
        padding: 10px 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .notification-message {
        font-weight: bold;
    }

    .notification-details {
        font-size: 0.9rem;
        color: #777;
    }

    .notification-link {
        color: #007bff;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
    }

    .notification-link:hover {
        text-decoration: underline;
    }
</style>

<style>
/* Style the container for notifications */
.notification-item {
    padding: 10px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

/* Style the notification content */
.notification-content {
    background-color: #f5f5f5;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>

<style>
   

   .empty-notifications-message{
       font-weight: bold;
               color: #999;
               /* Change the color to your preference */
               padding: 10px;
               text-align: center;
               background-color: #f0f0f0;
               /* Change the background color to your preference */
               border: 1px solid #ccc;
               border-radius: 5px;
               margin: 5px;
   }
           .empty-cart-message {
               font-weight: bold;
               color: #999;
               /* Change the color to your preference */
               padding: 10px;
               text-align: center;
               background-color: #f0f0f0;
               /* Change the background color to your preference */
               border: 1px solid #ccc;
               border-radius: 5px;
               margin: 5px;
           }
       </style>
          <style>
        /* Reduce the padding and margins of the footer */
.footer-top {
    padding-top: 0px; /* Adjust as needed */
    padding-bottom: 0px; /* Adjust as needed */
}

.footer-bottom {
    padding: 10px 0; /* Adjust as needed */
}
.footer-content .social-links{
    margin-top:6px;
    margin-bottom:15px
}
    </style>
    
    