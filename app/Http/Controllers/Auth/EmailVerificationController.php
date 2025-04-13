<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailOTP;
use App\Models\User;
use App\Notifications\EmailVerificationOTP;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmailVerificationController extends Controller
{
    public function showVerificationForm()
    {
        return view('auth.verify-otp');
    }

    public function sendOTP(Request $request)
    {
        $user = $request->user();
        
        // Generate 6 digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Create or update OTP record
        EmailOTP::updateOrCreate(
            ['user_id' => $user->id],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(10),
                'verified' => false
            ]
        );

        // Send OTP notification
        $user->notify(new EmailVerificationOTP($otp));

        return back()->with('status', 'Verification code sent!');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6'
        ]);

        $user = $request->user();
        $emailOTP = EmailOTP::where('user_id', $user->id)
            ->where('otp', $request->otp)
            ->where('verified', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$emailOTP) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // Mark OTP as verified
        $emailOTP->update(['verified' => true]);
        
        // Mark user as verified
        $user->markEmailAsVerified();

        return redirect()->route('home')
            ->with('success', 'Email verified successfully!');
    }
} 