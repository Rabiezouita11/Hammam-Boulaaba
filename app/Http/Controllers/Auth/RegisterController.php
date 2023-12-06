<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use anhskohbo\NoCaptcha\Rules\CaptchaRule;
use App\Rules\ReCaptcha;
use Monarobase\CountryList\CountryListFacade;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $countries = CountryListFacade::getList('en');
        return view('auth.register', compact('countries'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    public function redirectTo()
    {
        // Check if the service ID is stored in the session
        if (session()->has('service_id')) {
            $serviceId = session('service_id');
            session()->forget('service_id'); // Clear the session variable
            return "/service_{$serviceId}";
        }
        return '/login';
    }


    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'g-recaptcha-response' => ['required', 'string'], // Ensure it's a string

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $imagePath = null;

        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/users/' . $imageName;
            $image->storeAs('public', $imagePath); // You can customize the storage path
        }


        $user = User::create([
            'name' => $data['name'],
            'genre' => $data['genre'],
            'pays' => $data['pays'],
            'numero' => $data['phone'],
            'image' => $imagePath, // Save the image path in the database
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Send the welcome email
        Mail::to($user->email)->queue(new UserRegistered($user));

        return $user;
    }
}
