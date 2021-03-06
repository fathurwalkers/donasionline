<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:120'],
            'no_hp' => ['required', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:120', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // return redirect('/login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // Logika Default saat melakukan Register 
        // return User::create([
        //     'name' => $data['name'],
        //     'no_hp' => $data['no_hp'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

        // Logika Buatan saat melakukan register 
        $name = 'null';
        $no_hp = 'null';
        $email = Str::random(12);
        $email .= '@gmail.com';
        $password = Str::random(8);
        return User::create([
            'name' => $name,
            'no_hp' => $no_hp,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}
