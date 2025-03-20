<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthManager extends Controller
{
    public function login()
    {
        return view('user.auth.login');
    }
    public function loginSubmit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        try {
            // Attempt to log the user in
            if (Auth::attempt($request->only('email', 'password'))) {
                // Redirect to a specific route
                return redirect()->route('dashboard');
            } else {
                return back()->withErrors('Invalid credentials!');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors('Login failed! 500');
        }
    }
    public function register()
    {
        return view('user.auth.register');
    }
    public function regSubmit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'firstName' => 'required|string|max:40',
            'lastName' => 'required|string|max:40',
            'phoneNumber' => 'required|numeric|digits:10',
            'panNumber' => ['required', 'regex:/^[A-Z0-9]{10}$/'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        try {
            $response = '{
            "pan": "ABCPV1234D",
            "type": "Individual",
            "reference_id": 161,
            "name_provided": "JOHN DOE",
            "registered_name": "JOHN DOE",
            "valid": true,
            "message": "PAN verified successfully",
            "name_match_score": 100,
            "name_match_result": "DIRECT_MATCH",
            "aadhaar_seeding_status": "Y",
            "last_updated_at": "01/01/2019",
            "name_pan_card": "JOHN DOE",
            "pan_status": "VALID",
            "aadhaar_seeding_status_desc": "Aadhaar is linked to PAN"
            }';

            $response = json_decode($response);
            $allowedMatches = ['DIRECT_MATCH', 'GOOD_PARTIAL_MATCH'];
            //return $response;
           if($response->pan_status != 'VALID'){
               return back()->withErrors('PAN is not valid')->withInput();
           }elseif(!in_array($response->name_match_result, $allowedMatches)){
               return back()->withErrors('Name does not match with PAN')->withInput();
           }


            // Create a new user
            $user = new User();
            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->phoneNumber = $request->phoneNumber;
            $user->panNumber = $request->panNumber;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            // Log the user in
           Auth::login($user);
           
            // Redirect to a specific route
            return redirect(route('dashboard'))->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors('Registration failed!');
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect()->route('loginPage')->with(['success', 'Logged out successfully!']);
    }
}
