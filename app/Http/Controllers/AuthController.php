<?php

namespace App\Http\Controllers;

use App\Models\Traders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // --- STEP 1 ---
    public function showRegisterStep1()
    {
        return view('auth.register');
    }

    public function postRegisterStep1(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:100',
            'middleName' => 'nullable|string|max:100',
            'lastName' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'email' => 'required|email|unique:traders,email',
            'contactNumber' => 'required|string|max:11',
            'password' => 'required|string|min:8|confirmed',
            'zipCode' => 'required|string|max:4',
            'role' => 'nullable|string',
            'accountStatus' => 'nullable|string',
        ]);

        $validatedData['role'] = $validatedData['role'] ?? 'trader';
        $validatedData['accountStatus'] = $validatedData['accountStatus'] ?? 'active';
        try {
            $request->session()->put('registration_data', $validatedData);
            return redirect()->route('register.step2');
        } catch (\Exception $e) {
            Log::error('Step 1 Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred. Please try again.')->withInput();
        }
    }


    public function showRegistrationStep2(Request $request)
    {

        return view('auth.register-step2');
    }

    public function postRegisterStep2(Request $request)
    {
        $step1Data = $request->session()->get('registration_data');

        if (!$step1Data) {
            return redirect()->route('register.step1.show')->with('error', 'Your session expired. Please start over.');
        }

        $validatedStep2Data = $request->validate([
            'docType' => 'required|in:Drivers License,Passport,UMID/SSS/GSIS',
            'identityDoc' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            if ($request->hasFile('identityDoc')) {
                $path = $request->file('identityDoc')->store('identityDocs', 'public');
                $validatedStep2Data['identityDoc'] = $path;
            }

            $allData = array_merge($step1Data, $validatedStep2Data);

            $allData['password'] = Hash::make($allData['password']);

            $trader = Traders::create($allData);

            $request->session()->forget('registration_data');

            Auth::guard('trader')->login($trader);

            return redirect()->route('dashboard')->with('success', 'Registration completed successfully!');
        } catch (\Exception $e) {
            Log::error('Final Registration Step (Step 2) Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while finalizing your registration. Please try again.');
        }
    }



    // --- STEP 3 ---
    public function showRegistrationStep3(Request $request)
    {
        return view('auth.register-step3');
    }

    // public function storeRegistration(Request $request)
    // {
    //     if (!$request->session()->has('registration_data')) {
    //         return response()->json(['error' => 'Session expired. Please start over.'], 400);
    //     }

    //     $allData = $request->session()->get('registration_data');
    //     $request->validate(['face_image' => 'required|string']);
    //     $faceImageBase64 = $request->face_image;
    //     $apiKey = env('LUXAND_API_KEY');

    //     try {
    //         // --- STAGE 1: CREATE THE USER IN OUR DATABASE FIRST ---
    //         // This is still necessary to get a unique ID for the 'name' field.
    //         $allData['password'] = Hash::make($allData['password']);
    //         $trader = Traders::create($allData);

    //         // --- STAGE 2 (REVISED): CREATE PERSON AND ADD PHOTO IN A SINGLE API CALL ---
    //         // This is a more robust and atomic operation.
    //         $enrollResponse = Http::withHeaders(['token' => $apiKey])
    //             ->timeout(60)
    //             ->asJson()
    //             ->post('https://api.luxand.cloud/v2/person', [
    //                 'name'  => (string) $trader->id, // The unique name/ID for the person
    //                 'photo' => $faceImageBase64,     // The face image to enroll
    //                 'store' => 1                     // We must store this photo to create the gallery
    //             ]);

    //         // --- DEBUGGING: Log the response from this new, combined request ---
    //         Log::info('Luxand Enroll Person with Photo API Response:', [
    //             'status' => $enrollResponse->status(),
    //             'body' => $enrollResponse->json()
    //         ]);

    //         // --- STAGE 3: VALIDATE THE RESPONSE ---
    //         if ($enrollResponse->failed()) {
    //             $trader->delete(); // Clean up the user we created in our DB
    //             Log::error('Luxand Enroll API HTTP Error: ' . $enrollResponse->body());
    //             return response()->json(['error' => 'Could not create your face profile due to a server error.'], 500);
    //         }

    //         $enrollResult = $enrollResponse->json();
    //         // The most common logical error here is "No face found in photo"
    //         if (!isset($enrollResult['uuid'])) {
    //             $trader->delete(); // Clean up the user
    //             Log::error('Luxand Enroll API Logical Error: UUID not found in response.', ['response' => $enrollResult]);
    //             $errorMessage = $enrollResult['message'] ?? 'Could not process your face image. Please ensure your face is clear and centered.';
    //             return response()->json(['error' => $errorMessage], 400);
    //         }

    //         $personUuid = $enrollResult['uuid'];

    //         // --- STAGE 4: SAVE THE LUXAND ID TO OUR USER RECORD ---
    //         $trader->luxand_face_id = $personUuid;
    //         $trader->save();

    //         // --- FINISH UP ---
    //         $request->session()->forget('registration_data');
    //         Auth::login($trader);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Registration completed successfully!',
    //             'redirect_url' => route('dashboard'),
    //         ]);
    //     } catch (\Exception $e) {
    //         // Catch any other unexpected errors
    //         Log::error('Full Registration Exception: ' . $e->getMessage() . ' on line ' . $e->getLine());
    //         return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
    //     }
    // }

    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $traderCredentials = array_merge($credentials, ['role' => 'trader']);
        if (Auth::guard('trader')->attempt($traderCredentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }
        $adminCredentials = array_merge($credentials, ['role' => 'admin']);
        if (Auth::guard('admin')->attempt($adminCredentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('landing'));
    }
}
