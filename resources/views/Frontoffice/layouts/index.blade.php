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
    <link href="LOGO SITE WEBHA-01.png" rel="icon">
    <link href="LOGO SITE WEBHA-01.png" rel="apple-touch-icon">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Site Title -->
    <title>Hammam Boulaaba</title>
    <!-- Bootstrap css -->
    @if($currentLocale === 'ar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
    <link href="/client/{{ $currentLocale }}/assets/css/bootstrap.min.css" rel="stylesheet">

    @endif <!-- Icofont css -->


    <link href="/client/{{ $currentLocale }}/assets/css/icofont.css" rel="stylesheet">

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
    <link href="/client/fr/assets/css/responsive.css" rel="stylesheet">

    <link href="/client/{{ $currentLocale }}/assets/css/responsive.css" rel="stylesheet">

    @if($currentLocale === 'ar')
    <link href="/client/{{ $currentLocale }}/assets/css/rtl.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="/cssFrontoffice.css">

    <script src="/jsFrontoffice.js" defer></script>
    <script src="js/app.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">




    <script>
        $(document).ready(function() {
            // Check if the session variable 'azer' is set

            @if(session('profilechanger'))
            // Show the success modal
            $('#profileChanger').modal('show');
            @endif

            @if($errors -> has('old_password') || $errors -> has('new_password') || $errors -> has('confirm_password'))
            $(document).ready(function() {
                // Show the password modal if there are validation errors
                $('.passwordModal').modal('show');
            });
            @endif

        });
    </script>

</head>

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
<style>
    .navbar-collapse{
        text-align: center;
    }
</style>
<body data-bs-spy="scroll" data-bs-offset="70">


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
        </div><!-- /.container -->
    </nav>






    @yield('content')
















    <!-- End footer bottom -->
    <div class="fixed-button" id="reserver-button">
        <a href="#services">
            <button>Reserver</button>
        </a>
    </div>
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
                            <input type="file" class="form-control" id="file" name="image">
                        </div>
                        <div class="form-group">
                            <label for="email">Telephone</label>

                            <input id="phone" value="{{ Auth::user()->numero}}" type="tel" class="form-control" name="numero" required="" />

                        </div>

                        <div class="form-group">
                            <label for="email">Pays</label>

                            <select name="pays" id="pays" class="form-control mb-1" required>
                                @foreach ($countries as $countryCode => $countryName)
                                <option value="{{ $countryCode }}" @if (Auth::user()->pays === $countryCode) selected @endif>{{ $countryName }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="email">Genre</label>
                            <select name="genre" id="genre" class="form-control mb-1" required>
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
    <!-- modal mon changer password   -->
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




    <div class="modal fade" id="profileChanger" tabindex="-1" aria-labelledby="profileChangerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="passwordChangeSuccessModalLabel"> Profile modifié avec succès.</h1>
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

    <!-- Modal for password change success -->
    <div class="modal fade" id="passwordChangeSuccessModal" tabindex="-1" aria-labelledby="passwordChangeSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="passwordChangeSuccessModalLabel">Mot de passe modifié avec succès</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 10px;">
                    Mot de passe modifié avec succès.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
















    @auth

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

    @endauth
    <!-- Add this style block in your HTML's head or link to an external CSS file -->


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
                <div class="col-md-3">

                    <div class="footer-content">

                        <ul class="social-links">
                            <li>
                                <a href="https://www.facebook.com/hammamboulaaba"> <i class="fab fa-facebook"></i>

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
                    <p> {{ $translator->translate('Copyright 2023 all rights by') }} <a href="https://www.e-build.tn/" target="_blank" style="color: red; border-bottom: 2px solid red;"> Ebuild </a></p>
                </div>
            </div>
        </div>
    </footer>




    <script src="/client/{{ $currentLocale }}/assets/js/jquery.min.js"></script>
    <!-- Bootstrap js file -->
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
    <!-- Active js file -->
    <script src="/client/{{ $currentLocale }}/assets/js/active.js"></script>


</body>