<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegistrationController extends Controller
{
     public function show()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:100',
            'middleName' => 'nullable|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:100',
            'contactNumber' => 'required|string|max:11',
            'password' => 'required|string|min:8|confirmed',
            'zipCode' => 'nullable|string|max:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user = User::create([
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'username' => $request->firstName . ' ' . $request->lastName,
            'email' => $request->email,
            'address' => $request->address,
            'contactNumber' => $request->contactNumber,
            'city' => $request->city,
            'country' => $request->country,
            'province' => $request->province,
            'zipCode' => $request->zipCode,
            'password' => Hash::make($request->password),
        ]);


            return redirect()->route('register')
                ->with('success', 'Registration successful! Welcome to EcoTrade.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Registration failed. Please try again.')
                ->withInput();
        }
}
}