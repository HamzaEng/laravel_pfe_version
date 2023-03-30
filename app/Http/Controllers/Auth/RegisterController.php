<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\candidat;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'lieuNs' => ['required', 'string', 'max:255'],
            'lycee' => ['required', 'string', 'max:255'],
            'cne' => ['required', 'string', 'max:12'],
            'cin' => ['required', 'string', 'max:12'],
            'tel' => ['required', 'numeric', 'digits:10'],
            'bacMoyen' => ['required', 'numeric'],
            'niveauBac' => ['required', 'string', 'max:255'],
            'filiere' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        return candidat::create([
            'name' => $data['name'],
            'prenom' => $data['prenom'],
            'dateNs' => $data['dateNs'],
            'lieuNs' => $data['lieuNs'],
            'tel' => $data['tel'],
            'lycee' => $data['lycee'],
            'bacMoyen' => $data['bacMoyen'],
            'niveauBac' => $data['niveauBac'],
            'cin' => $data['cin'],
            'cne' => $data['cne'],
            'filiere' => $data['filiere'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
