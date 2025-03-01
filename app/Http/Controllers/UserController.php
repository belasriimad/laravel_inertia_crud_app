<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\AuthUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display the registration form
     */
    public function create()
    {
        return Inertia::render('Users/Register');
    }

    /**
     * Store the user
     */
    public function store(AddUserRequest $request)
    {
        if($request->validated()) {
            //save the user
            $user = User::create([
                'name' =>$request->name,
                'email' =>$request->email,
                'password' =>Hash::make($request->password),
            ]);

            //login the user
            auth()->login($user);

            //regenerate the session
            $request->session()->regenerate();

            //redirect the user to the home page 
            return redirect()->route('home');
        }
    }

    /**
     * Display the login form
     */
    public function login()
    {
        return Inertia::render('Users/Login');
    }

    /**
     * Login the user
     */
    public function auth(AuthUserRequest $request)
    {
        if($request->validated()) {
            //try to log in the user
            if(auth()->attempt([
                'email' =>$request->email,
                'password' =>$request->password
            ])) {    
                //regenerate the session
                $request->session()->regenerate();
                //redirect the user to the home page 
                return redirect()->route('home');
            }else {
                throw ValidationException::withMessages([
                    'email' => 'These credentials do not match any of our records.'
                ]);
            }
        }
    }

    /**
     * Logout the user
     */
    public function logout(Request $request)
    {
        //logout the user
        auth()->logout();
        //regenerate the session
        $request->session()->regenerate();
        //redirect the user to the home page 
        return redirect()->route('home');
    }
}
