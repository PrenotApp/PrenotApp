<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Approved;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

// your imports
use App\Models\School;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'code' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'verification_code' => ['nullable']
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
        $code = strtoupper($data['code']);
        $school = School::where('code', $code)->first();
        // check school
        if (!$school) {
            throw ValidationException::withMessages(['code' => 'Codice scuola non valido.']);
        }

        $data['role'] = '';
        $userCount = User::where('school_id', $school->id)->count(); // user in that school

        if (User::count() === 0) { // user in the db
            $data['role'] = 'manager';
        } else if ($userCount === 0) { // user in the school
            $data['role'] = 'admin';
        } else {
            $approved = Approved::where('email', $data['email'])->where('school_id', $school->id)->first();

            if(!$approved){
                throw ValidationException::withMessages(['email' => 'Docente non abilitato, contatta il tuo admin.']);
            } else {
                $data['role'] = 'common';
            }

        }

        $data['verification_code'] = rand(100000, 999999); // Codice di verifica generato (esempio con 6 cifre)

        $user = User::create([
            'name' => Str::title($data['name']), // Ogni parola con la maiuscola
            'email' => $data['email'],
            'school_id' => $school->id,
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'verification_code' => $data['verification_code'],
        ]);

        return $user;
    }
}
