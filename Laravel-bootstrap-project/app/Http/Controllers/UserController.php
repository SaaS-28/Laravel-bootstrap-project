<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Function for register
    public function register(Request $request) {
        // Setting up requirements to go ahead with the registration - validate is used to check if the text picked up in the fields corresponds to our requirements
        $incomingFileds = $request->validate([
            'username' => ['required', 'min:3', 'max:10', Rule::unique('users', 'username')], // "required" means that we must enter a username, "min" and "max" means the min and the max amount of letters to type. "Rule unique" means that the data we are going to save in the database is unique, so no one else can have the same username or email
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:20', 'confirmed'] // 'confirmed' ensures the password is confirmed
        ]);

        $incomingFileds['password'] = bcrypt($incomingFileds['password']); // Hashes the password - It uses "blowfish" to hash
        $user = User::create($incomingFileds); // Creates a new record in the database
        auth()->login($user); // It automatically login the user after registration - "auth" is used for authentication

        return redirect('/');
    }

    // Function for login
    public function login(Request $request) {
        $incomingFileds = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        // "attempt" is used to login the user, so it cheks if the username and the password stored in the database is the same as the username and password of the user 
        if(auth()->attempt(['username' => $incomingFileds['loginusername'], 'password' => $incomingFileds['loginpassword']])) {
            $request->session()->regenerate(); // This is used to create a new ID of the session and disabilitate the old one. This provides that no one can access an account by using an old ID
            return redirect('/');
        }

        return redirect('/')
        ->withErrors(['login' => 'Incorrect credentials'], 'login') // Allows to show errors in the login errors bag
        ->withInput(); // Keeps the credentials previously written by the user
    }

    // function for logout
    public function logout() {
        auth()->logout(); // This makes the user disconnect from his account
        return redirect('/');
    }
}
