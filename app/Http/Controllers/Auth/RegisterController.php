<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

// your imports
use App\Models\School;
use Illuminate\Support\Str;
use App\Notifications\VerifyEmailCode;

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
            'code' => ['required', 'exists:schools,code'],
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
        $school = School::where('code', $data['code'])->first();
        // check school
        if (!$school) {
            throw ValidationException::withMessages(['code' => 'Codice scuola non valido.']);
        }

        $data['role'] = 'common';
        $userCount = User::where('school_id', $school->id)->count(); // user in that school

        if (User::count() === 0) { // user in the db
            $data['role'] = 'manager';
        } else if ($userCount === 0) { // user in the school
            $data['role'] = 'admin';
        }

        $data['verification_code'] = Str::random(6);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'school_id' => $school->id,
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'verification_code' => $data['verification_code'],
        ]);

        // dd($user);

        $user->notify(new VerifyEmailCode('AAAAAA'));

        return $user;
    }
}
