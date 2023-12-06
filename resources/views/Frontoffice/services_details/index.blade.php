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
    $translator->setTarget($currentLocale); 
    $translatedLocale = $translator->translate(strtoupper(app()->getLocale()));

@endphp
<html lang="{{ $currentLocale }}" @if ($currentLocale === 'ar') dir="rtl" @endif>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Site Title --><title>Hammam Boulaaba
        </title>
        <link href="/logo station thermale-01.png" rel="icon"> <link
        href="/logo station thermale-01.png" rel="apple-touch-icon">

        <!-- Bootstrap css -->
        @if ($currentLocale === 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
        @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        @endif
        <!-- Icofont css -->
        <link
        href="https://cdn.jsdelivr.net/npm/icofont@1.0.0/dist/icofont.min.css" rel="stylesheet">
        <!-- Owl.carousel css -->
        <link
        href="/client/{{ $currentLocale }}/assets/css/owl.carousel.css" rel="stylesheet">
        <!-- Animate css -->
        <link
        href="/client/{{ $currentLocale }}/assets/css/animate.min.css" rel="stylesheet">
        <!-- Magnific popup css -->
        <link href="/client/{{ $currentLocale }}/assets/css/magnific-popup.css" rel="stylesheet">
        <!-- Jquery-ui css -->
        <!-- Style css -->
        <link
        href="/client/{{ $currentLocale }}/assets/css/style.css" rel="stylesheet"> <!-- Responsive css -->
        <link
        href="/client/{{ $currentLocale }}/assets/css/responsive.css" rel="stylesheet">
        <!-- RTL css -->
        @if ($currentLocale === 'ar')
        <link href="/client/{{ $currentLocale }}/assets/css/rtl.css" rel="stylesheet">
        @endif
        <script src="/assets/fullcalendar/dist/index.global.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="/jsFrontoffice.js" defer></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="/cssFrontoffice.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            $(document).ready(function () { // Check if the session variable 'azer' is set

                @if(session('profilechanger'))
                // Show the success modal
                $('#profileChanger').modal('show');
                @endif
                @if(session('passwordChangeSuccess'))
                // Show the success modal
                $('#passwordChangeSuccessModal').modal('show');
                @endif
                @if($errors -> has('old_password') || $errors -> has('new_password') || $errors -> has('confirm_password'))
                $(document).ready(function () { // Show the password modal if there are validation errors
                    $('.passwordModal').modal('show');
                });
                @endif

            });
        </script>

<style>
    .close {
        font-size: 24px;
        font-weight: bold;
        color: red;
        background-color: rgba(255, 255, 255, 0.5); /* Adjust the alpha value (0.5 for 50% transparency) */
        border:2px solid #fff;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
    }
  
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
   
    .close:hover {
        background-color: rgba(255, 255, 255, 0.7); /* Adjust the alpha value on hover */
    }
</style>

    </head>

    <body data-bs-spy="scroll" data-bs-offset="70">
    <style>
    .navbar-collapse{
        text-align: center;
    }
</style>
        <style>
            
            /* Reduce the padding and margins of the footer */
            .footer-top {
                padding-top: 0;
                /* Adjust as needed */
                padding-bottom: 0;
                /* Adjust as needed */
            }

            .footer-bottom {
                padding: 10px 0;
                /* Adjust as needed */
            }

            .footer-content {
                margin-bottom: 0;
            }
        </style>
        <style>
            .navbar .navbar-nav > li > a {
                text-transform: none;
            }

            @media(min-width: 300px) {
                .d-sm-block {
                    display: block !important
                }
            }

            .navbar-nav li a {
                white-space: nowrap;
                /* Prevent text from wrapping */
                overflow: hidden;
                /* Hide overflowing text */
                text-overflow: ellipsis;
                /* Display ellipsis (...) for overflowing text */
            }
        </style>
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

        <!-- Start Navbar -->
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
            <div
                class="container">

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
            <!-- /.navbar-collapse -->
        </div><!-- /.container --></body>
</html></nav><style>
/* Style the cart container */
#panier-container {
    max-height: 487px;
    /* Adjust the max height as needed */
    overflow-y: auto;
}

/* Style the cart items */
#panier {
    list-style-type: none;
    /* Remove list bullet points */
    padding: 0;
    margin: 0;
}

/* Add styling for each cart item (li) */
#panier li {
    padding: 3px;
    border-bottom: 1px solid #ddd;
    /* Optional: Add a bottom border to separate items */
}

/* Add hover effect on cart items */
#panier li:hover {
    background-color: #f5f5f5;
    /* Customize the hover background color */
}</style><!-- End Navbar --><!-- Start page header --><section class="page-header-section" style="margin-top: 140px;">
<div class="container">
    <div class="row">
        <div class="col-md-6">


            <h1>
                {{ $translator->translate($services->categories) }}
            </h1>
        </div>

        <div class="col-md-6">
            <ul class="header-breadcrumb">
                <li>
                    <a href="index.html">
                        {{ $translator->translate('Accueil') }}
                    </a>
                </li>
                <li>/</li>
                <li class="active">
                    {{ $translator->translate($services->categories) }}</li>
            </ul>
        </div>
    </div>
</div></section><center>
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ $translator->translate(session('success')) }}

</div>
@endif</center><!-- End page header --><!-- START BLOG MAIN AREA --><section id="blog" class="blog-main-area">
<div class="container">
    <div class="row">
        <div
            class="col-md-8">
            <!-- Blog details content -->
            <div class="blog-details-content">
                <div class="post-image">
                    <img src="/storage/{{ $services->image }}" alt=""/>
                    
                </div>
                <div class="fixed-button" id="reserver-button">
                    <a href="#Calendar">
                        <button href="#Calendar">   {{ $translator->translate('Réserver') }}</button>
                    </a>
                </div>
                <div class="blog-details-textarea">
                    @if (auth()->check())
                    <h4 class="title">
                        {{ $translator->translate($services->Designations) }}
                        @else
                        <h4 class="title">
                            {{ $translator->translate($services->Designations) }}
                            <br>
                            <br>
                            <a style="text-align: center;" type="button" class="btn btn-primary" href="/login?service_id={{ $services->id }}">
                                {{ $translator->translate('Connectez-vous pour réserver') }}
                            </a>
                        </h4>
                        @endif
                        <br>
                        <br>


                    </h4>
                    <div class="post-admin">
                        <a href="#">
                            {{ $translator->translate('Prix') }}
                        </a>
                        <a href="#">
                            <i class="icofont icofont-money"></i>
                            {{ $services->prix }}
                            {{ $translator->translate('TND') }}
                        </a>






                    </div>
                    <div class="post-admin">
                        <a href="#">
                            {{ $translator->translate('Methode de Tarification') }}
                        </a>
                        @if ($services->methode_tarification == 'par_place')
        <i class="icofont icofont-users"></i> {{-- Use the appropriate icon for 'par_place' --}}
        {{ $translator->translate('Par Place') }}
    @elseif ($services->methode_tarification == 'par_reservation')
        <i class="icofont icofont-calendar"></i> {{-- Use the appropriate icon for 'par_reservation' --}}
        {{ $translator->translate('Par Réservation') }}
    @else
        {{-- Handle other cases if needed --}}
    @endif





                        
                    </div>
                    @if ($services->methode_tarification == 'par_place')
                    <div class="post-admin">
                        <a href="#">
                            {{ $translator->translate('capacite') }}
                        </a>
                        <a href="#">
                            <i class="icofont icofont-ui-user"></i>
                            {{ $services->capacite }}
                        </a>
                    </div>


                    @else



                    @endif

                  
                    <div class="post-admin">
                        <a href="#">
                            {{ $translator->translate('Durée') }}
                        </a>
                        <a href="#">
                            <i class=" icofont icofont-clock-time"></i>
                            {{ $services->dure }}
                            {{ $translator->translate('Heure') }}
                        </a>
                    </div>

                    <div class="post-admin">
                        <a style="color: #0d6efd;">
                            {{ $translator->translate('Description') }}
                        </a>
                        :
                        <p style="max-width: 100%; word-wrap: break-word;">
                            {{ $translator->translate($services->Description) }}
                        </p>
                    </div>


                </div>
            </div>
            <!-- End blog details content -->

            <!-- Comments -->

            <!-- End Comments -->

            <!-- Comments form -->
            @if (auth()->check())
               
                  <style>

.modal-body{
    padding: 3px 16px 0px;
}
#calendar {
    max-width: 100%;
    margin: auto;
  }

  /* Media query for smaller screens */
  @media (max-width: 767px) {
    #calendar {
      padding: 10px; /* Adjust padding for smaller screens */
    }
  }
                </style>
                
                <div
                    id="calendar"><!-- Your calendar content goes here -->
                </div>
           
            @else
            <div class="not-logged-in-container">
                <p class="not-logged-in-message">
                    {{ $translator->translate('Vous devez être connecté pour accéder au calendrier et effectuer des réservations.') }}
                </p>
                <p class="not-logged-in-link">
                    {{ $translator->translate('Merci de') }}
                    <a href="/login?service_id={{ $services->id }}">
                        {{ $translator->translate('vous connecter') }}
                    </a>
                    {{ $translator->translate('pour utiliser cette fonctionnalité.') }}
                </p>
            </div>
            @endif
            <style>
      
                /* Common styles */
                .calendar-container,
                .not-logged-in-container {
                    text-align: center;
                    margin: 20px;
                    padding: 20px;
                    background-color: #f2f2f2;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                }

                .calendar-title {
                    font-size: 24px;
                    color: #333;
                }

                .not-logged-in-message {
                    font-size: 18px;
                    color: #FF0000;
                    /* Red color for the message */
                }

                .not-logged-in-link a {
                    font-size: 16px;
                    color: #007BFF;
                    /* Blue color for the login link */
                    text-decoration: none;
                }

                .not-logged-in-link a:hover {
                    text-decoration: underline;
                }
            </style>


            <!-- End comments form -->
        </div>

        <div class="col-md-4">
            <div
                class="sidebar-area">


                <!-- Popular posts -->
                <div class="recent-post-box">
                    <h4 class="title">
                        {{ $translator->translate('Services similaire') }}
                    </h4>
                    @if ($ServicesSimilaire->isEmpty())
                    <div class="shop-cart">
                        <div class="product-text">
                            <p>{{ $translator->translate("il n'y a pas de services similaires") }}</p>
                        </div>
                    </div>
                    @else
                                                    @forelse($ServicesSimilaire as $service)
                                                        @if ($service->categories === $services->categories)
                    <div class="recent-post" style="font-size: 30px;">
                        <a href="/service_{{ $service->id }}">

                            <img src="/storage/{{ $service->image }}" alt=""/>
                        </a>
                        <h4>
                            <a href="/service_{{ $service->id }}">
                                {{ $translator->translate($service->Designations) }}</a>
                        </h4>
                        <!-- <h4> categories : <a >{{ $service->categories }}</a></h4> -->
                        <p class="post-dt">{{ $service->created_at }}
                        </p>
                        <!-- <a href="#" class="comments"><i class="icofont icofont-comment"></i> 12</a> -->
                    </div>
                    @endif
                                                    @empty
                    <div class="shop-cart">
                        <div class="product-text">
                            <p></p>
                            <p>{{ $translator->translate('Aucun article disponible dans cette catégorie.') }}
                            </p>
                        </p>
                    </div>
                </div>
                @endforelse
                                            @endif


            </div>
            <!-- End opular posts -->

            <!-- Recent posts -->
            <div class="recent-post-box">
                <h4 class="title">{{ $translator->translate('Autre Services') }}
                </h4>
                @foreach ($Service as $service)
                                                @if ($service->id !== $excludedService->id && $service->categories !== $excludedService->categories)
                <div class="recent-post">
                    <a href="/service_{{ $service->id }}">
                        <img src="/storage/{{ $service->image }}" alt=""/>
                    </a>
                    <h4>
                        <a href="/service_{{ $service->id }}">{{ $translator->translate($service->Designations) }}</a>
                    </h4>
                    <p class="post-dt">{{ $service->created_at }}
                    </p>
                </div>
                @endif
                                            @endforeach
                
                                            @if ($Service->where('id', '!=', $excludedService->id)->where('categories', '!=', $excludedService->categories)->isEmpty())
                <div class="shop-cart">
                    <div class="product-text">
                        <p></p>
                        <p>{{ $translator->translate('Aucun article disponible dans cette catégorie.') }}
                        </p>
                    </div>
                </div>
                @endif
            </div>

            <!-- End Recent posts -->
        </div>
    </div>
</div></div></section><!-- END BLOG MAIN AREA --><!-- Start footer top --><footer class="footer-top section-bg"><div class="container">
<div class="row">
    <div class="col-md-3">
        <div class="footer-content">
            <a href="/home"><img src="/LOGO SITE WEBHA-01.png" height="150px" width="150px" alt=""/></a>


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
                    <p> {{ $translator->translate('Copyright 2023 all rights by') }} <a href="https://www.e-build.tn/"
                            target="_blank" style="color: red; border-bottom: 2px solid red;">
                           Ebuild </a></p>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog"
        aria-labelledby="updateProfileModalLabel" aria-hidden="true">
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
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Image</label>
                                <!-- Display user's image if it exists -->
                                @if (Auth::user()->image)
                                    <img src="/storage/{{ Auth::user()->image }}" alt="User Image" height="250px"
                                        width="250px" class="img-fluid mb-2">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=104d93&color=fff'"
                                        height="250px" width="250px" alt="" class="mr-2">
                                @endif
                                <!-- Input for updating the user's image -->
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="email">Telephone</label>

                                <input id="phone" value="{{ Auth::user()->numero }}" type="tel"
                                    class="form-control" name="numero" required="" />

                            </div>

                            <div class="form-group">
                                <label for="email">Pays</label>

                                <select name="pays" id="pays" class="form-control mb-1" required>
                                    @foreach ($countries as $countryCode => $countryName)
                                        <option value="{{ $countryCode }}"
                                            @if (Auth::user()->pays === $countryCode) selected @endif>{{ $countryName }}
            </option>
            @endforeach
        </select>

    </div>
    <div class="form-group">
        <label for="email">Genre</label>
        <select name="genre" id="genre" class="form-control mb-1" required>
            <option value="">Select genre</option>
            <option value="Femme" @if (Auth::user()->genre === 'Femme') selected @endif>Femme
            </option>
            <option value="Homme" @if (Auth::user()->genre === 'Homme') selected @endif>Homme
            </option>
        </select>
    </div>


    <!-- Add other form fields for pays, numero, image, genre, etc. -->

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endguest</div></div></div></div><div class="modal fade" id="placesModal" tabindex="-1" role="dialog" aria-labelledby="placesModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header">
<h5 class="modal-title" id="placesModalLabel">
    {{ $translator->translate('Sélectionnez un créneau horaire') }}
</h5></div><div class="modal-body">
<input type="number" id="placesInput" class="form-control" placeholder="{{ $translator->translate('Entrez le nombre de places') }}" required></div><div class="modal-footer">
<button type="button" class="btn btn-secondary" id="dismiss" data-dismiss="modal">
    {{ $translator->translate('Fermer') }}
</button>
<button type="button" class="btn btn-primary" id="confirmPlaces">
    {{ $translator->translate('Confirmer') }}
</button></div></div></div></div><div class="modal" tabindex="-1" role="dialog" id="confirmDeleteModal"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header">
<h5 class="modal-title">
    {{ $translator->translate('Confirmation de la suppression') }}
</h5>


<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">  <span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
<p>
    {{ $translator->translate('Êtes-vous sûr de vouloir supprimer cet service ?') }}
</p></div><div class="modal-footer">
<button type="button" class="btn btn-secondary" id="fermerSupprimer" data-dismiss="modal">{{ $translator->translate('Fermer') }}</button>
<button type="button" class="btn btn-danger" id="confirmDeleteButton">
    {{ $translator->translate('Supprimer') }}
</button></div></div></div></div><!-- End footer bottom --><div class="modal fade passwordModal" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><form method="POST" action="/update_password">
@csrf
<div class="modal-header">
    <h1 class="modal-title fs-5" id="passwordModalLabel">Changer le mot de passe</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div
    class="modal-body">
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
</div></form></div></div></div><div class="modal fade" id="passwordChangeSuccessModal" tabindex="-1" aria-labelledby="passwordChangeSuccessModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">
<h1 class="modal-title fs-5" id="passwordChangeSuccessModalLabel">Mot de passe modifié avec succès
</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body" style="padding: 10px;">
Mot de passe modifié avec succès.</div><div class="modal-footer">
<button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button></div></div></div></div><div class="modal fade" id="profileChanger" tabindex="-1" aria-labelledby="profileChangerModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">
<h1 class="modal-title fs-5" id="passwordChangeSuccessModalLabel">Mot de passe modifié avec succès
</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body" style="padding: 10px;">
Profile modifié avec succès.</div><div class="modal-footer">
<button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button></div></div></div></div><!-- jQuery (necessary for Bootstrap's JavaScript plugins) --><!-- Bootstrap js file --><script src="/client/{{ $currentLocale }}/assets/js/jquery.min.js"></script><script src="/client/{{ $currentLocale }}/assets/js/bootstrap.min.js"></script><!-- Owl.carousel js file --><script src="/client/{{ $currentLocale }}/assets/js/owl.carousel.min.js"></script><!-- Jquery.magnific-popup js file --><script src="/client/{{ $currentLocale }}/assets/js/jquery.magnific-popup.min.js"></script><!-- Velocity min JS file --><script src="/client/{{ $currentLocale }}/assets/js/velocity.min.js"></script><!-- Velocity.ui min JS file --><script src="/client/{{ $currentLocale }}/assets/js/velocity.ui.min.js"></script><!-- Jquery-ui JS file --><!-- Google recaptcha JS --><!-- Active js file --><script src="/client/{{ $currentLocale }}/assets/js/active.js"> </script><div id="service-nom" style="display: none;">{{ $services->Designations }}</div>
<div id="service-methode-tarification" style="display: none;">{{ $services->methode_tarification }}</div>

<div id="dure-minutes"  style="display: none;">{{ $services->minutes }}</div>
<div id="service-promotion" style="display: none;">{{ $services->promotion }}</div> 
<div id="dure-pause" style="display: none;">{{ $services->pause }}</div>
<div id="service-id" style="display: none;">{{ $services->id }}</div><div id="Montant-service-id" style="display: none;">{{ $services->prix }}</div><div id="dure-service-id" style="display: none;">{{ $services->dure }}</div>@guest



@else<div id="User-id" style="display: none;">{{ Auth::user()->id }}</div>@endguest
        @auth
            @php
                $currentLocale = app()->getLocale();
                $translator = new GoogleTranslate();
                $translator->setTarget($currentLocale);
                $translatedToday = $translator->translate('today');
    
                $translatedMonth = $translator->translate('month');
                $translatedWeek = $translator->translate('week');
                $translatedDay = $translator->translate('day');
            @endphp
            @php
                $placeholderTranslation = $translator->translate('Entrez le nombre de places');
            @endphp
            
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
<style>
  .fc-header-toolbar {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
  }

  .fc-toolbar-title {
    font-size: 1.5em; /* Adjust font size as needed */
  }

  .fc-button-group {
    margin-top: 10px; /* Adjust spacing between buttons */
    display: flex;
    align-items: center;
  }

  /* Media query for smaller screens */
  @media (max-width: 767px) {
    .fc-toolbar-title {
      font-size: 1.2em; /* Adjust font size for smaller screens */
    }

    .fc-button-group {
      margin-top: 5px; /* Adjust spacing for smaller screens */
    }
  }
</style>

<script>

function showSpinner() { // Show the overlay with the spinner
    document.getElementById('overlay').style.display = 'flex';

}

function hideSpinner() { // Hide the overlay
    document.getElementById('overlay').style.display = 'none';
}
var placeholderTranslation = "{!! addslashes($placeholderTranslation) !!}";
var placeholderAdulte = "Entrez le nombre de places adultes";
var placeholderEnfants = "Entrez le nombre de places enfants";

var translatedToday = "{{ $translatedToday }}";
var currentLocale = "{{ $currentLocale }}";
document.addEventListener('DOMContentLoaded', function () {

    var SITEURL = "/addToPanier";
    var SITEURL1 = "/";
    @guest
    @else
    var user_ids = {{ auth()->user()->id }}; // Get the user_id from Laravel auth
    @endguest
    var service_id = document.getElementById('service-id').textContent;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    async function generateTimeSlots(duration,pause, formattedDate) {
    var timeSlots = [];
   
    
    // var duration = { hours: 2, minutes: 0 } ;
    // Convert the formatted date string back to a Date object
    var currentDate = new Date(formattedDate);

    // Set the time zone offset to 0 (UTC)
    currentDate.setMinutes(currentDate.getMinutes() - currentDate.getTimezoneOffset());

    // Calculate the end time of the day (20:00:00)
    var endOfDay = new Date(currentDate);
    endOfDay.setUTCHours(20, 0, 0, 0);

    while (currentDate < endOfDay) {
        var startTime = currentDate.toISOString().slice(0, 19).replace("T", " ");

        // Calculate the end time based on the duration
        var endTimeDate = new Date(currentDate);
        endTimeDate.setUTCHours(currentDate.getUTCHours() + duration.hours);
        endTimeDate.setUTCMinutes(currentDate.getUTCMinutes() + duration.minutes);

        // Check if the calculated end time exceeds the end of the day
        if (endTimeDate >= endOfDay) {
            endTimeDate = new Date(endOfDay); // Set end time to the end of the day
        }

        var endTime = endTimeDate.toISOString().slice(0, 19).replace("T", " ");

        // Make an AJAX request to check slot availability
        try {
            const response = await fetch('/check-slot-availability', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    start: startTime,
                    end: endTime,
                    service_id: service_id,
                }),
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();

            // Handle the response, which will include 'is_available' property
            if (data.is_available) {
                // Check if start and end times are not null before pushing to the array
                if (data.start !== null && data.end !== null) {
                    // Push the time slot to the array
                    timeSlots.push({
                        start: data.start,
                        end: data.end,
                    });
                }
            }
        } catch (error) {
            if (error.message.includes('419')) {
            location.reload();
        }
            console.error('Error checking slot availability:', error);
            // Log the error and continue to the next iteration
            continue;
           
        }

        // Move to the next time slot by adding the duration
        currentDate.setUTCHours(currentDate.getUTCHours() + duration.hours);
        currentDate.setUTCMinutes(currentDate.getUTCMinutes() + duration.minutes);

        // Add break time to the start time for the next iteration (except for the last iteration)
        if (timeSlots.length > 0 && currentDate < endOfDay) {
            currentDate.setUTCMinutes(currentDate.getUTCMinutes() + pause);
        }
    }

    return timeSlots;
}





    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: '{{ $translatedLocale }}', // Set the locale dynamically
        allDaySlot: false, // Set this to false to remove the "all-day" slot

        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            omitZeroMinute: false,
            hour12: false
        },
        slotMinTime: '08:00',
        slotMaxTime: '20:00',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
            today: currentLocale === 'fr' ? "aujourd'hui" : translatedToday,
            month: '{{ $translatedMonth }}', // Customize the "month" button
            week: '{{ $translatedWeek }}', // Customize the "week" button
            day: '{{ $translatedDay }}' // Customize the "day" button
        },
        initialDate: new Date(),
        navLinks: true,
        selectable: false,
        selectMirror: true,

        dateClick: function (info) {
    // Check if the clicked view is timeGridDay
    if (info.view.type === 'timeGridDay') {
        var today = new Date(); // Get the current date
            var selectedDate = info.date;
            // Format the date to 'yyyy-mm-dd'
            function formatDate(date) {
                var year = date.getFullYear();
                var month = String(date.getMonth() + 1).padStart(2, '0');
                var day = String(date.getDate()).padStart(2, '0');
                var time = '08:00:00'; // Add the desired time here
                return `${year}-${month}-${day} ${time}`;
            }
            function formatDate2(date) {
    var hours = String(date.getHours()).padStart(2, '0');
    var minutes = String(date.getMinutes()).padStart(2, '0');
    
    return `${hours}:${minutes}`;
}

            // console.log(formatDate(selectedDate));

            // Check if there's an existing event on the selected day
            var existingEvent = calendar.getEvents().find(function (event) {
                return event.start.toDateString() === info.date.toDateString();
            });

            if (existingEvent) {
                if (existingEvent.extendedProps.status !== 'old' && existingEvent.extendedProps.user_id === user_ids) { // Allow the current user to delete their own events
                    existingEvent.remove();

                    // Send a request to delete the event from the backend for the current user
                    $.ajax({
                        url: '/deleteCartItem',
                        type: 'POST',
                        data: {
                            item_id: existingEvent.id
                        },
                        success: function (response) {
                            displayMessage(response.message);
                            $.ajax({
                                    url: '/get-updated-cart',
                                    type: 'GET',
                                    success: function (cartResponse) {
                                        var cart = $('#panier');
                                        cart.html('');
                                        var countpanier = $('#countPanier');
                                        countpanier.html(cartResponse.cartItems.length);
                                        if (cartResponse.cartItems.length > 0) {
                                            cartResponse.cartItems.forEach(function (item) {
                                                var cartItemHTML = `
                                            <li>
                                                <div class="shop-cart">
                                                    <div class="product_img">
                                                        <a href="#"><img src="/storage/${
                                                    item.service.image
                                                }" alt="" /></a>
                                                    </div>
                                                    <div class="product-text">
                                                        <span class="title">${
                                                    item.service.Designations
                                                }</span>
                                                        <span class="quantity">Quantity: ${
                                                    item.nombre_de_place
                                                } <span>${
                                                    item.service.prix
                                                } TND</span></span>
                                                        <form action="/delete-panier-item/${
                                                    item.id
                                                }" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="delete-button">
                                                                <i class="icofont icofont-close"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        `;
                                                cart.append(cartItemHTML);
                                            });
                                            var cartSummaryHTML = `
                                        <li>
                                            <div class="shop-cart-checkout">
                                                <div class="shop-cart-text">
                                                    <p>Subtotal :</p>
                                                    <span>${
                                                cartResponse.subtotal
                                            } TND</span>
                                                </div>
                                                <a href="/front-pages/checkout">paiement</a>
                                            </div>
                                        </li>
                                    `;
                                            cart.append(cartSummaryHTML);
                                        } else {
                                            cart.append('<li class="empty-cart-message"> {{ $translator->translate('Votre panier est vide..') }}</li>');
                                        }
                                    },
                                    error: function (error) {
                                        console.log(error);
                                    }
                                });
                            // Now, proceed with adding the new event
                            // ... (your code for adding a new event)
                        },
                        error: function (error) {
                            displayMessageErreur(error.responseJSON.message);
                        }
                    });
                } else if (existingEvent.extendedProps.status === 'old' && existingEvent.extendedProps.user_id === user_ids) { // Display an error message for other users trying to delete old events
                    displayMessageErreur('{{ $translator->translate("Vous ne pouvez pas ajouter un nouveau service le même jour qu\'un événement ancien.") }}');

                    calendar.unselect();
                    return;
                } else { // You can add your additional logic here
                }
            }


            // var selectedHours = (arg.end - arg.start) / (60 * 60 * 1000);

            // var servvie_duree = document.getElementById('dure-service-id').textContent;
            // if (selectedHours != servvie_duree) {
            //     displayMessageErreur('Sélectionnez exactement ' + servvie_duree + ' heures pour ce service.');
            // calendar.unselect();
            // return

            //         }
            var service_id = document.getElementById('service-id').textContent;
            var user_id = document.getElementById('User-id').textContent;
            var service_nom = document.getElementById('service-nom').textContent;
            var service_methode_tarification = document.getElementById('service-methode-tarification').textContent;
            var  service_promotion = document.getElementById('service-promotion').textContent

           

            $('#placesModal').modal('show');
            var minutesElement = document.getElementById('dure-minutes');

var serviceIdElement = document.getElementById('dure-service-id');


            var serviceDuration =  { hours: parseInt(serviceIdElement.textContent), minutes: parseInt(minutesElement.textContent) };
            var selectedTimeSlot = null;
            var pauseElement = document.getElementById('dure-pause');
var pause = pauseElement ? parseInt(pauseElement.textContent) : 0;
           
            generateTimeSlots(serviceDuration,pause, formatDate(selectedDate))
    .then(function (timeSlots) {
        var modalBody = $('#placesModal .modal-body');
        modalBody.empty();
        modalBody.append('<ul>');

        if (Array.isArray(timeSlots)) {
            timeSlots.forEach(function (slot) {
                modalBody.append(`
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="timeSlot" data-start="${slot.start}" data-end="${slot.end}">
                            <label class="form-check-label">${formatDate2(new Date(slot.start))} - ${formatDate2(new Date(slot.end))}</label>
                        </div>
                    </li>
                `);
            });

            modalBody.append('</ul>');
            modalBody.append('<br>');
            if (service_promotion === '1') {
                // If promotion is active, show two input fields for adults and children
                modalBody.append('<input type="number" id="placesInputAdults" class="form-control" placeholder="' + placeholderAdulte + '" required>');
                modalBody.append('<br>');
                modalBody.append('<input type="number" id="placesInputChildren" class="form-control" placeholder="' + placeholderEnfants + '" >');
                modalBody.append('<br>');
            } else {
                // If promotion is not active, show a single input field
                modalBody.append('<input type="number" id="placesInput" class="form-control" placeholder="' + placeholderTranslation + '" required>');
            }                  
        var placesInput = document.getElementById('placesInput');
       
       if (service_methode_tarification === 'par_place') {
           // Show the places input
           if (placesInput) {
               placesInput.style.display = 'block';
               
           } else {
               console.error('Places input element not found.');
           }
       } else {

           // Hide the places input
           if (placesInput) {
               placesInput.style.display = 'none';
           } else {
               console.error('Places input element not found.');
           }
       }
 
       var selectedTimeSlot = null;

$('input[name="timeSlot"]').on('change', function () {
selectedTimeSlot = {
   start: $(this).data('start'),
   end: $(this).data('end')
};

});
       $('#confirmPlaces').off('click');
       $('#confirmPlaces').click(function () {
           if (!selectedTimeSlot) {
               displayMessageErreur('{{ $translator->translate("Sélectionnez d\'abord un créneau horaire.") }}');

               return;
           }
           var nombre_de_place;
           var  newMontant;
           var montant_total = parseFloat(document.getElementById('Montant-service-id').textContent) || 0;
           if (service_promotion === '1') {
    // If promotion is active, use the values from both inputs
    var nombre_de_placeAdults = $('#placesInputAdults').val();
    var nombre_de_placeChildren = $('#placesInputChildren').val();

    // Combine the values into a single string or format as needed
    var adults = parseInt(nombre_de_placeAdults) || 0;
    var children = parseInt(nombre_de_placeChildren) || 0;

    // Calculate the sum
    var sum = adults + children;

    // Update 'nombre_de_place' with the sum
    nombre_de_place = sum;
    if (sum > 2) {
       
        
        // Apply the formula
        newMontant = 2 * montant_total + (adults - 2) * 10 + children * 5;
     
    } else {
        // If the sum is not greater than 2, set newMontant to null or some default value
        newMontant = montant_total; // You can set a default value here if needed
    }

} else {
    // If promotion is not active, use the value from the regular input
    nombre_de_place = $('#placesInput').val();
    newMontant = montant_total; // You can set a default value here if needed
    
}

          
         


           if (service_promotion === '1') {
            if (nombre_de_placeAdults.trim() === '' &&  service_methode_tarification === 'par_place') {
               displayMessageErreur('{{ $translator->translate('Veuillez entrer le nombre de places adultes .') }}');

               return;
           }
           if ( parseInt(nombre_de_placeAdults)  == 0 || parseInt(nombre_de_placeAdults) < 0    ) {
        displayMessageErreur('{{ $translator->translate('Veuillez entrer un nombre de places  adultes supérieur ou égal à 0.') }}');
        return;
    }

           }
        


    if (service_promotion === '0') {
        if (parseInt(nombre_de_place) == 0 || parseInt(nombre_de_place) < 0) {

displayMessageErreur('{{ $translator->translate('Veuillez entrer un nombre de places supérieur à 0.') }}');

return;
}
if (nombre_de_place.trim() === '' &&  service_methode_tarification === 'par_place') {
displayMessageErreur('{{ $translator->translate('Veuillez entrer le nombre de places.') }}');

return;
}

    }
          

           showSpinner(); // Call this function before making the AJAX request

           $.ajax({
               url: SITEURL,
               type: "POST",
               data: {
                nombre_de_placeChildren : nombre_de_placeChildren,
                nombre_de_placeAdults : nombre_de_placeAdults ,
                   service_id: service_id,
                   nombre_de_place: nombre_de_place,
                   montant_total: newMontant,
                   user_id: user_id,
                   start: selectedTimeSlot.start,
                   end: selectedTimeSlot.end

               },
               complete: function (xhr) {
        if (xhr.status == 419) {
            // CSRF token mismatch, reload the page
            location.reload();
        }
    },
               success: function (response) {
                   hideSpinner(); // Call this function in the success callback
                   $('#placesInput').val('');

                   $('#placesModal').modal('hide');
                   var message = service_nom + ' ajouté au panier';


                   displayMessage(message);
                   var eventData = response.event;
                   eventData.justIcon = '<i class="fas fa-star"></i>';

                   calendar.addEvent(eventData);
                   calendar.unselect();
                   calendar.render();
                   if (eventData.capacite === eventData.nombreDePlaces) {
                       eventData.title = ' <i class="fas fa-trash-alt"></i> Réservé';
                   } else {
                       eventData.title = '<i class="fas fa-trash-alt"></i> Réservé';
                   }
                  
                   $.ajax({
                       url: '/get-updated-cart',
                       type: 'GET',
                       success: function (cartResponse) {

                           var cart = $('#panier');
                           cart.html('');
                           var countpanier = $('#countPanier');
                           countpanier.html(cartResponse.cartItems.length);

                           if (cartResponse.cartItems.length > 0) {
                               cartResponse.cartItems.forEach(function (item) {


                                   var cartItemHTML = `
                                               <li>
                                                   <div class="shop-cart">
                                                       <div class="product_img">
                                                           <a href="#"><img src="/storage/${
                                       item.service.image
                                   }" alt="" /></a>
                                                       </div>
                                                       <div class="product-text">
                                                           <span class="title">    ${
                                       item.service.Designations
                                   }</span>
                                                           <span class="quantity">  {{ $translator->translate('Quantity') }}: ${
                                       item.nombre_de_place
                                   } * <span>${
                                       item.service.prix
                                   } TND</span></span>
                                                           <form action="/delete-panier-item/${
                                       item.id
                                   }" method="post">
                                   @csrf
                                   @method('delete')
                                   <button type="submit" class="delete-button">
                                       <i class="icofont icofont-close"></i>
                                   </button>
                               </form>
                                                           </div>
                                                   </div>
                                               </li>
                                           `;
                                   cart.append(cartItemHTML);
                               });
                               var cartSummaryHTML = `
           <li>
        <div class="shop-cart-checkout">
       <div class="shop-cart-text">
           <p>   {{ $translator->translate('Subtotal') }}    :</p>
           <span>${
                                   cartResponse.subtotal
                               }   {{ $translator->translate('TND') }}  </span>
       </div>
       <a href="/front-pages/checkout">   {{ $translator->translate('paiement') }} </a>
          </div>
       </li>
        `;
                               cart.append(cartSummaryHTML);
                           } else {
                               cart.append('<li class="empty-cart-message">   {{ $translator->translate('Votre panier est vide..') }}</li>');
                           }
                       },
                       error: function (error) {
                           console.log(error);
                       }
                   });
               },
               error: function (error) {
                   hideSpinner(); // Call this function in the error callback

                   if (error.responseJSON.message === 'CSRF token mismatch') { // Reload the page when a CSRF token mismatch error occurs
                       location.reload();
                   } else { // Handle other errors
                       displayMessageErreur(error.responseJSON.message);
                       $('#placesModal').modal('show');

                       $('#placesInput').val('');
                      
                      
                   }

               }

           });
          
       
       });

        } else {
            console.error('Error: generateTimeSlots did not return an array.');
        }
    })
    .catch(function (error) {
        console.error('Error generating time slots:', error);
    });


           
     

    }
},
       
        eventClick: function (arg) {
            if (arg.view.type === 'timeGridDay') {

            if (arg.event.extendedProps.user_id == user_ids) {
                if (arg.event.extendedProps.status === 'old') { // Display a message indicating that old events can't be deleted
                    displayMessageErreur('{{ $translator->translate('Vous ne pouvez pas supprimer un service ancien.') }}');

                } else {
                    $('#confirmDeleteModal').modal('show');
                    $('#confirmDeleteButton').off('click');

                    $('#confirmDeleteButton').on('click', function () {
                        showSpinner(); // Call this function before making the AJAX request

                        $.ajax({
                            url: '/deleteCartItem',
                            type: 'POST',
                            data: {
                                item_id: arg.event.id
                            },
                            success: function (response) {
                                hideSpinner();

                                displayMessage(response.message);
                                arg.event.remove();
                                $.ajax({
                                    url: '/get-updated-cart',
                                    type: 'GET',
                                    success: function (cartResponse) {
                                        var cart = $('#panier');
                                        cart.html('');
                                        var countpanier = $('#countPanier');
                                        countpanier.html(cartResponse.cartItems.length);
                                        if (cartResponse.cartItems.length > 0) {
                                            cartResponse.cartItems.forEach(function (item) {
                                                var cartItemHTML = `
                                            <li>
                                                <div class="shop-cart">
                                                    <div class="product_img">
                                                        <a href="#"><img src="/storage/${
                                                    item.service.image
                                                }" alt="" /></a>
                                                    </div>
                                                    <div class="product-text">
                                                        <span class="title">${
                                                    item.service.Designations
                                                }</span>
                                                        <span class="quantity">Quantity: ${
                                                    item.nombre_de_place
                                                } <span>${
                                                    item.service.prix
                                                } TND</span></span>
                                                        <form action="/delete-panier-item/${
                                                    item.id
                                                }" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="delete-button">
                                                                <i class="icofont icofont-close"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        `;
                                                cart.append(cartItemHTML);
                                            });
                                            var cartSummaryHTML = `
                                        <li>
                                            <div class="shop-cart-checkout">
                                                <div class="shop-cart-text">
                                                    <p>Subtotal :</p>
                                                    <span>${
                                                cartResponse.subtotal
                                            } TND</span>
                                                </div>
                                                <a href="/front-pages/checkout">paiement</a>
                                            </div>
                                        </li>
                                    `;
                                            cart.append(cartSummaryHTML);
                                        } else {
                                            cart.append('<li class="empty-cart-message"> {{ $translator->translate('Votre panier est vide..') }}</li>');
                                        }
                                    },
                                    error: function (error) {
                                        console.log(error);
                                    }
                                });
                                $('#confirmDeleteModal').modal('hide');
                            },
                            error: function (error) {
                                displayMessageErreur(error.responseJSON.message);
                            }
                        });
                    });
                }
            } else { // Display a message indicating that the user cannot delete events that don't belong to them
                displayMessageErreur('{{ $translator->translate('Vous ne pouvez pas supprimer cet événement car il ne vous appartient pas.') }}');

            }
        }
        },

        editable: false,
        dayMaxEvents: false,

        events: `/events?user_id=${user_ids}&service_id=${service_id}`,
        eventContent: function (arg) {
    const status = arg.event.extendedProps.status;
    const nombreDePlaces = arg.event.extendedProps.nombreDePlaces;
    const capacite = arg.event.extendedProps.capacite;
    const NomUser = arg.event.extendedProps.NomUser;
    const title = arg.event.extendedProps.title;

    
    const serviceTotalNombreDePlaces = arg.event.extendedProps.serviceTotalNombreDePlaces;

    const content = document.createElement('div');
    content.classList.add('fc-event-main');

    if (status === 'old') {
        content.style.backgroundColor = 'gray';
        // You can apply other custom styling for "old" events
    }

    if (arg.view.type === 'dayGridMonth') {
        content.innerHTML = ''; // Leave the content empty for dayGridMonth view
    } else if (arg.view.type === 'timeGridDay') {
        // Updated condition to check for "Réservé" based on serviceTotalNombreDePlaces
        if (capacite == serviceTotalNombreDePlaces ) {
            content.innerHTML = `Réservé`; // For events with equal capacite and nombreDePlaces
        } else {
            content.innerHTML = `${NomUser} (${nombreDePlaces} places)`; // For other events, show the user's name and number of places
        }
    } else {
        content.innerHTML = arg.event.title; // Customize the content for other views
    }

    return { domNodes: [content] };
}
,
        select: function (arg) {
  
    if (calendar.view.type === 'dayGridMonth') {
      
    }
},

        selectAllow: function (selectInfo) {
            if (calendar.view.type === 'dayGridMonth') {
                calendar.gotoDate(selectInfo.start);
                calendar.changeView('timeGridDay');
                return false;
            }
            return true;
        },
        validRange: {
            start: new Date()
        }
    });

    calendar.render();

    $('#dismiss').click(function () {
        $('#placesModal').modal('hide');
        $('#placesInput').val('');
    });

    $('#fermerSupprimer').click(function () {
        $('#confirmDeleteModal').modal('hide');

    });

    function displayMessage(message) {
        toastr.options = {
            closeButton: true, // Show the close button
            positionClass: 'toast-bottom-right', // Display the toast at the top and center
        };
        toastr.success(message, '{{ $translator->translate('notification') }}');
    }

    function displayMessageErreur(message) {
        toastr.options = {
            closeButton: true, // Show the close button
            positionClass: 'toast-bottom-right', // Display the toast at the top and center
        };
        toastr.error(message, '{{ $translator->translate('notification') }}');
    }
});</script>
<script>document.addEventListener("DOMContentLoaded",function(){var t=document.querySelector("#phone");const n=document.querySelector("#pays");if(t&&n){const e=window.intlTelInput(t,{utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",initialCountry:"tn",nationalMode:!1});n.addEventListener("change",function(){var t=this.value;e.setCountry(t)})}});</script>
    <style>/* Style the delete button with the icofont icon */
.delete-button {
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-size: 24px;
    /* Adjust the font size as needed */
    color: red;
    /* Customize the color */
}

/* Change the icon color on hover */
.delete-button:hover {
    color: darkred;
    /* Customize the hover color */
}</style>@endauth<style>/* Style the delete button with the icofont icon */
.delete-button {
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-size: 24px;
    /* Adjust the font size as needed */
    color: red;
    /* Customize the color */
}

/* Change the icon color on hover */
.delete-button:hover {
    color: darkred;
    /* Customize the hover color */
}</style><style>/* Style the delete button with the icofont icon */
/* Style the delete button with the icofont icon */
.delete-notification-button {
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-size: 24px;
    /* Adjust the font size as needed */
    color: red;
    /* Customize the color */
    float: right;
    /* Align to the right */
}

/* Change the icon color on hover */
.delete-notification-button:hover {
    color: darkred;
    /* Customize the hover color */
}

/* Style the message container to contain the message and delete button */
.message-container {
    text-align: left;
    /* Align the message text to the left */
}</style>@auth<script src="/js/app.js"></script><script>document.addEventListener("DOMContentLoaded", function () {
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
        adminLogo.setAttribute('width', '50'); // Set the desired width in pixels

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
            return "il ya " + interval + " month(s) ";
        }
        interval = Math.floor(seconds / 86400);
        if (interval >= 1) {
            return "il ya " + interval + " day(s) ";
        }
        interval = Math.floor(seconds / 3600);
        if (interval >= 1) {
            return "il ya " + interval + " hour(s) ";
        }
        interval = Math.floor(seconds / 60);
        if (interval >= 1) {
            return "il ya " + interval + " minute(s) ";
        }
        return "il ya " + Math.floor(seconds) + " second(s) ";
    }


    function deleteNotification(notificationId) {
        fetch(`/delete-notification/${notificationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                const deletedNotification = document.querySelector(`[data-notification-id="${notificationId}"]`);
                if (deletedNotification) {
                    deletedNotification.remove();
                    if (countValue > 0) {
                        countValue--; // Decrease the count only if it's greater than 0
                    }notificationCount.textContent = countValue;
                    notificationCount.setAttribute('data-count', countValue);
                    displayMessage('{{ $translator->translate('La notification a été supprimée avec succès.') }}');

                    checkAndDisplayNoNotifications();
                }
            }
        }).catch(error => {
            console.error('Error deleting notification:', error);
            displayMessageErreur(error);
        });
    }


    function fetchDatabaseNotificationsAndDisplay() {
        fetch('/fetch-database-notifications').then(response => response.json()).then(data => {
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
        }).catch(error => {
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
                'Content-Type': 'application/json'
            }
        }).then(response => response.json()).then(data => {
            fetchDatabaseNotificationsAndDisplay();
        }).catch(error => {
            console.error('Error marking all notifications as read:', error);
        });
    }

    const markAllReadButton = document.getElementById('mark-all-read-button');
    markAllReadButton.addEventListener('click', markAllNotificationsRead);

    function checkAndDisplayNoNotifications() {
        const noNotificationsMessage = document.querySelector('.empty-notifications-message');

        if (notificationsList.children.length === 0) {
            if (! noNotificationsMessage) {
                const newNoNotificationsMessage = document.createElement('li');
                newNoNotificationsMessage.textContent = '{{ $translator->translate('Pas de notifications disponibles') }}';;
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
        toastr.success(message, '{{ $translator->translate('notification') }}');
    }

    function displayMessageErreur(message) {
        toastr.options = {
            closeButton: true, // Show the close button
            positionClass: 'toast-bottom-right', // Display the toast at the top and center
        };
        toastr.error(message, '{{ $translator->translate('notification') }}');
    }
});</script>@endauth<!-- Add this style block in your HTML's head or link to an external CSS file --><style>.notification-item {
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
}</style><style>/* Style the container for notifications */
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
}</style><style>.empty-notifications-message {
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
}</style><script>$('#placesModal').on('shown.bs.modal', function () {
    $('#placesInput').focus();
});</script><style>/* Apply styles to the button */
.fixed-button button {
    position: fixed;
    /* Fixed position */
    top: 50%;
    /* Adjust as needed to vertically center the button */
    right: 3px;
    /* Adjust as needed to set the horizontal position */
    transform: rotate(90deg) translateY(-80%);
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    display: inline-block;
    z-index: 8000;
    /* Set a high z-index value to make it appear above other elements */

}


/* Style the button on hover */
.fixed-button button:hover {
    background-color: #0056b3;
}</style></body></html>
