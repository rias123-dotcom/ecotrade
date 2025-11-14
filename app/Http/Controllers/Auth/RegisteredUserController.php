<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Traders;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $validateInformation = $request->validate([
        //     'firstName' => 'required|string|max:50',
        //     'middleName' => 'nullable|string|max:50',
        //     'lastName' => 'required|string|max:50',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'contactNumber' => 'required|string|max:11',
        //     'address' => 'required|string|max:100',
        //     'city' => 'required|string|max:100',
        //     'country' => 'required|string|max:100',
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        // try {
        //     Traders::create($validateInformation);
        //     return redirect(route('dashboard', absolute: false));
        // } catch (\Exception $e) {
        //     Log::error('Registration Error: ' . $e->getMessage());
        //     return back()->withErrors(['error' => 'An error occurred while processing your registration. Please try again.']);
        // }
    }
}
