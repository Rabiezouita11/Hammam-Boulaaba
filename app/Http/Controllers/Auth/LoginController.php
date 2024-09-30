<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
     * |--------------------------------------------------------------------------
     * | Login Controller
     * |--------------------------------------------------------------------------
     * |
     * | This controller handles authenticating users for the application and
     * | redirecting them to your home screen. The controller uses a trait
     * | to conveniently provide its functionality to your applications.
     * |
     */

    use AuthenticatesUsers;
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        // Check if the service ID is stored in the session
        if (session()->has('service_id')) {
            $serviceId = session('service_id');
            session()->forget('service_id');  // Clear the session variable
            return "/service_{$serviceId}";
        }

        if (Auth::check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 'client':
                    return '/home';
                case 'admin':
                    return '/app/user/list';
                default:
                    return '/login';
            }
        } else {
            return '/login';  // Redirect to the login page if the user is not authenticated
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    
}
