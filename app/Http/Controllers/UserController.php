<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    //Create New User
    public function store(Request $request) {
        //validation
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6' //confirm makes sure that other input field with underscore _confirmation is the same
        ]);
        //Hash Password (with bcrypt)
        $formFields['password'] = bcrypt($formFields['password']);
        //Create User
        $user = User::create($formFields); 
        //Login
        auth()->login($user);
        //redirect
        return redirect('/')->with('message', 'User created and logged in.'); //return with flash message
    }
}
