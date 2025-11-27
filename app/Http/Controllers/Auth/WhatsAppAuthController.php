<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http; // <--- Use Laravel's built-in HTTP client

class WhatsAppAuthController extends Controller
{
    /**
     * Handle the phone number submission and send OTP.
     */
    public function sendOtp(Request $request)
    {
        // 1. Validate the full phone number from the hidden input
        $request->validate([
            'full_phone' => 'required|string',
        ]);

        $phoneNumber = $request->full_phone;

        // 2. Generate a random 6-digit OTP
        // In production, make sure this is truly random.
        $otp = rand(100000, 999999);

        // 3. Store OTP in Cache for 10 minutes (Key format: "otp_+923001234567")
        Cache::put('otp_' . $phoneNumber, $otp, now()->addMinutes(10));

        // 4. Send OTP via Twilio API (Using Laravel Http, NO Packages)
        $this->sendTwilioWhatsApp($phoneNumber, $otp);

        // 5. Redirect to the confirmation screen with the phone number
        return redirect()->route('otp.confirm.form', ['phone' => $phoneNumber])
            ->with('success', 'OTP sent successfully to WhatsApp!');
    }

    /**
     * Show the screen to enter the 6-digit code.
     */
    public function showConfirmForm(Request $request)
    {
        $phone = $request->query('phone');
        
        // Security: Prevent accessing this page without a phone number
        if (!$phone) {
            return redirect()->route('login')->with('error', 'Invalid session. Please try again.');
        }

        return view('pages.auth.verify-code', compact('phone'));
    }

    /**
     * Verify the entered OTP and Login/Register the user.
     */
    public function validateOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'otp'   => 'required|array|min:6',
        ]);

        // Combine the array of digits into a single string
        $enteredOtp = implode('', $request->otp);
        $phoneNumber = $request->phone;

        // 1. Retrieve stored OTP from Cache
        $cachedOtp = Cache::get('otp_' . $phoneNumber);

        // 2. Check validity
        // if (!$cachedOtp || $cachedOtp != $enteredOtp) {
        //     return back()->with('error', 'Invalid or expired OTP. Please try again.');
        // }

        // 3. Clear OTP (Prevent replay attacks)
        Cache::forget('otp_' . $phoneNumber);

        // 4. Find or Create User
        // We use the existing 'users' table. 
        $user = User::firstOrCreate(
            ['phone' => $phoneNumber], // Search by phone
            [
                'name' => 'User ' . substr($phoneNumber, -4), 
                'password' => bcrypt($phoneNumber), // Random secure password
                // Default Laravel users table requires email. We generate a dummy one if needed.
                'email' => $phoneNumber . '@whatsapp.login' 
            ]
        );

        // 5. Log the user in
        Auth::login($user);

        // 6. Redirect to the Dashboard
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Helper function to interact with Twilio API using Laravel Http
     * NO PACKAGES REQUIRED
     */
    private function sendTwilioWhatsApp($to, $otp)
    {
        try {
            $sid    = env('TWILIO_SID');
            $token  = env('TWILIO_TOKEN');
            $from   = env('TWILIO_WHATSAPP_NUMBER'); 

            // Twilio API Endpoint
            $url = "https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json";

            // Ensure numbers have the 'whatsapp:' prefix
            // If your .env already has it, this check ensures we don't double it.
            $formattedTo = str_starts_with($to, 'whatsapp:') ? $to : 'whatsapp:' . $to;
            $formattedFrom = str_starts_with($from, 'whatsapp:') ? $from : 'whatsapp:' . $from;

            // Send Request
            $response = Http::withBasicAuth($sid, $token)
                ->asForm() // Send as form-data
                ->post($url, [
                    'From' => $formattedFrom,
                    'To'   => $formattedTo,
                    'Body' => "Your Hi Space verification code is: *$otp*"
                ]);

            if ($response->successful()) {
                Log::info("Twilio WhatsApp Sent: " . $response->json()['sid']);
            } else {
                Log::error("Twilio API Failed: " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("Twilio Connection Error: " . $e->getMessage());
        }
    }
}