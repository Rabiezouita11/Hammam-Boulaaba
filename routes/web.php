<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$controller_path = 'App\Http\Controllers';





Route::get('/lang/{locale}', $controller_path . '\LocalizationController@changeLocale')->middleware('lang.switch');


// get notification in frontoffice
Route::get('/fetch-database-notifications', $controller_path . '\ClientController@fetchDatabaseNotifications')->middleware('check.client');

// delete notificiations in front office
Route::delete('/delete-notification/{notificationId}', $controller_path . '\ClientController@deleteNotification')->name('notifications.delete')->middleware('check.client');


// check slot avaible or not

Route::post('/check-slot-availability', $controller_path . '\ClientController@checkSlotAvailability')->middleware('check.client');

// mark a notification as read
// Route::put('/mark-notification-as-read/{notification}', $controller_path . '\ClientController@markAsRead')->middleware('check.client');
Route::post('/mark-all-notifications-read', $controller_path . '\ClientController@markAllRead')->middleware('auth');
// front office  fr 



Route::get('/home', $controller_path . '\ClientController@index')->name('home')->middleware('check.client');
Route::get('/service_{id}', $controller_path . '\ClientController@showdetailsService')->name('showdetailsService')->middleware('check.client');

// button send message Contact

Route::post('/contact', $controller_path . '\ContactController@sendEmail');


// generates the QR code


Route::get('/generate-qr-code/{data}', $controller_path . '\QRCodeController@generateQRCode')->name('generate-qr-code');


Route::get('/codeqr_{reservationId}', $controller_path . '\QRCodeController@showQRCode')->name('show-qr-code');


// button changer password
Route::post('/update_password', $controller_path . '\ClientController@update_password')->name('update_password')->middleware('auth');

// button modifier profile 
Route::post('/update_profile', $controller_path . '\ClientController@EditProfile')->name('EditProfile')->middleware('check.client');


// show reservation for client 
Route::get('/mes_reservation', $controller_path . '\ClientController@showreservations')->name('showreservations')->middleware('auth');


// front office  ar 

// front office show details service


// add to panier 
Route::post('/addToPanier', $controller_path . '\ClientController@addToPanier')->name('addToPanier')->middleware('auth');;
// show service into calender of user  
Route::get('/events', $controller_path . '\ClientController@getPanierEvents')->name('getPanierEvents')->middleware('auth');;

// supprimer panier from calender 
Route::post('/deleteCartItem', $controller_path . '\ClientController@deleteCartItem')->name('deleteCartItem')->middleware('auth');;


// update panier without refrech 


Route::get('/get-updated-cart', $controller_path . '\ClientController@getUpdatedCart')->name('getUpdatedCart')->middleware('auth');;



// button supprimer from panier 
Route::delete('/delete-panier-item/{id}', $controller_path . '\ClientController@deleteItem')->name('delete-panier-item')->middleware('auth');;


// Paiment 

Route::get('/payment-success', $controller_path . '\paimentController@paymentSuccess')->name('payment-success')->middleware('auth');
Route::get('/payment-failure', $controller_path . '\paimentController@paymentFailure')->name('payment-failure')->middleware('auth');


// Admin 





// delete notifications 

Route::delete('/delete-notificationAdmin/{id}', $controller_path . '\dashboard\Analytics@delete')->name('delete.notification')->middleware('role:admin');

// fetch notificaitions 

Route::get('/fetch-notifications', $controller_path . '\front_pages\Checkout@fetchNotifications')->name('fetchNotifications')->middleware('role:admin');


//  mark Payment in controller
Route::post('/mark-payment/{reservation}', $controller_path . '\apps\List_reservation_admin@markPayment')->name('markPayment')->middleware('role:admin');
// mar payment in view (filter)
Route::post('/paye', $controller_path . '\apps\List_reservation_admin@markPaymentFilter')->name('markPaymentFilter')->middleware('role:admin');

// show chaque reservation  

Route::get('/get-panier-events/{reservationId}', $controller_path . '\apps\List_reservation_admin@getPanierEvents');

// button supprimer client 
Route::delete('/users/{user}', $controller_path . '\apps\UserList@destroy')->name('users.destroy')->middleware('role:admin');
// button ajouter client
Route::post('/addUser', $controller_path . '\apps\UserList@addUser')->name('adduser')->middleware('role:admin');


// Main Page Route
Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics')->middleware('role:admin');

Route::get('/dashboard/crm', $controller_path . '\dashboard\Crm@index')->name('dashboard-crm');
// locale
Route::get('lang/{locale}', $controller_path . '\language\LanguageController@swap');

// layout

// Front Pages


// show checkout coter client
Route::get('/front-pages/checkout', $controller_path . '\front_pages\Checkout@index')->name('front-pages-checkout')->middleware('check.client');

Route::post('/update-cart-item-quantity', $controller_path . '\front_pages\Checkout@updateCartItemQuantity')->name('updateCartItemQuantity')->middleware('check.client');

// update profile checkout 
Route::post('/updateProfilecheckout', $controller_path . '\front_pages\Checkout@updateProfilecheckout')->name('updateProfilecheckout')->middleware('check.client');

// confiramtion Reservation

Route::post('/confirm-reservation', $controller_path . '\front_pages\Checkout@confirmReservation')->name('confirm-reservation')->middleware('check.client');



Route::get('/front-pages/help-center', $controller_path . '\front_pages\HelpCenter@index')->name('front-pages-help-center');
Route::get('/front-pages/help-center-article', $controller_path . '\front_pages\HelpCenterArticle@index')->name('front-pages-help-center-article');

// apps
Route::get('/app/email', $controller_path . '\apps\Email@index')->name('app-email');
Route::get('/app/chat', $controller_path . '\apps\Chat@index')->name('app-chat');

// show calender
Route::get('/app/Reservation/calender', $controller_path . '\apps\Calendar@index')->name('app-Reservation-calender');
// show count service each day


Route::get('/services-in-panier-month/{startOfMonth}/{endOfMonth}', $controller_path . '\apps\Calendar@getServicesInPanierMonth')->name('getServicesInPanierMonth');
Route::get('/get-panier-events', $controller_path . '\apps\Calendar@getPanierEvents');



// show list user to admin  
Route::get('/app/user/list', $controller_path . '\apps\UserList@index')->name('app-user-list');

// show list services t oadmin 

Route::get('/app/Services/Services', $controller_path . '\apps\ServicesController@index')->name('app-Services-Services');

// show search user admin 
Route::get('/search', $controller_path . '\apps\UserList@search')->name('search');

// show list de reservations
Route::get('/getReservations', $controller_path . '\apps\List_reservation_admin@getReservations')->name('getReservations');

// search filter par date nombre de reservations 
Route::get('/getReservationData', $controller_path . '\apps\List_reservation_admin@getReservationData')->name('getReservationData');





//show page of liste de reservations

Route::get('/app/Reservation/liste', $controller_path . '\apps\List_reservation_admin@index')->name('app-Reservation-liste');


// show search services to admin 

Route::get('/searchServices', $controller_path . '\apps\ServicesController@search')->name('searchServices');

// button supprimer Service 
Route::delete('/service/{service}', $controller_path . '\apps\ServicesController@destroy')->name('service.destroy');

// button modifier service
Route::put('/updateService/{updateService}', $controller_path . '\apps\ServicesController@update')->name('updateService');

// button ajouter services 
Route::post('/addService', $controller_path . '\apps\ServicesController@addService')->name('addService');

// show notification coter admin 
Route::get('/api/get-notifications', $controller_path . '\dashboard\Analytics@getNotifications');
// marke notification read 
Route::post('/mark-notifications-as-read', $controller_path . '\dashboard\Analytics@markAsRead');

// accepter reservation coter admin 
Route::post('/accept-reservation', $controller_path . '\apps\Calendar@acceptReservation')->name('acceptReservation');

// refuser reservation coter admin

Route::post('/Refuser-reservation', $controller_path . '\apps\Calendar@RefuserReservation')->name('RefuserReservation');



// pages

// authentication


// wizard example

// cards

// User Interface

// extended ui

// icons

// form elements


// tables

Auth::routes();



Route::get('/Testpayment/{subtotalAmount}', $controller_path . '\front_pages\Checkout@initiatePayment')->name('testpayment')->middleware('auth');
