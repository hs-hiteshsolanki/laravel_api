<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\userslogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Define the master number and OTP
        $masterNumber = '9727691355';
        $masterOtp = '1010';

        // Determine OTP and expiry time
        if ($request->mobile_number == $masterNumber) {
            $otp = $masterOtp;
        } else {
            $otp = rand(100000, 999999);
        }
        // $otpExpiryTime = now()->addMinutes(1); // Set OTP expiry time (e.g., 5 minutes from now)
        // Set OTP expiry time for IST (Indian Standard Time)
        $otpExpiryTime = Carbon::now('Asia/Kolkata')->addMinutes(1);

        // Check if the user exists
        $user = userslogin::where('mobile_number', $request->mobile_number)->first();

        if (!$user) {
            // Create a new user if not exists
            $user = userslogin::create([
                'mobile_number' => $request->mobile_number,
                'otp' => $otp,
                'otp_expires_at' => $otpExpiryTime,
            ]);
        } else {
            // Update the existing user with the new OTP and expiry time
            $user->otp = $otp;
            $user->otp_expires_at = $otpExpiryTime;
            $user->save();
        }

        // Simulate sending OTP via SMS (in production, integrate with an SMS service)
        return response()->json([
            'status' => 1,
            'message' => 'Success',
            'is_number_verify' => $user->is_number_verify,
            'otp' => $otp, // Send OTP in the response for testing (remove this in production)
        ]);
    }

    public function verifyOtp(Request $request)
    {
        // Define the master number and OTP
        $masterNumber = '9727691355';
        $masterOtp = '1010';

        // Verify OTP for master number
        if ($request->mobile_number == $masterNumber && $request->otp == $masterOtp) {
            $user = userslogin::where('mobile_number', $request->mobile_number)->first();
            $user->is_number_verify = 1;
            $user->api_token = Hash::make($request->mobile_number . now());
            $user->save();

            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'mobile_number' => $user->mobile_number,
                'api_token' => $user->api_token,
            ]);
        }

        // Verify OTP for other numbers
        $user = userslogin::where('mobile_number', $request->mobile_number)
            ->where('otp', $request->otp)
            ->first();

        if ($user) {
            $user->is_number_verify = 1;
            $user->api_token = Hash::make($request->mobile_number . now());
            $user->save();

            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'mobile_number' => $user->mobile_number,
                'api_token' => $user->api_token,
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'OTP not match',
        ]);
    }

    // public function login(Request $request)
    // {
    //     $otp = rand(100000, 999999);
    //     $otpExpiryTime = now()->addMinutes(5); // Set OTP expiry time (e.g., 5 minutes from now)

    //     $user = userslogin::where('mobile_number', $request->mobile_number)->first();

    //     if (!$user) {
    //         $user = userslogin::create([
    //             'mobile_number' => $request->mobile_number,
    //             'otp' => $otp,
    //             'otp_expires_at' => $otpExpiryTime,
    //         ]);
    //     } else {
    //         $user->otp = $otp; // Corrected assignment of OTP
    //         $user->otp_expires_at = $otpExpiryTime;
    //         $user->save();
    //     }

    //     // Simulate sending OTP via SMS (in production, integrate with an SMS service)
    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'Success',
    //         'is_number_verify' => $user->is_number_verify,
    //         'otp' => $otp, // Send OTP in the response
    //     ]);
    // }

    // public function verifyOtp(Request $request)
    // {
    //     $user = userslogin::where('mobile_number', $request->mobile_number)
    //         ->where('otp', $request->otp)
    //         ->first();

    //     if ($user) {
    //         $user->is_number_verify = 1;
    //         $user->api_token = Hash::make($request->mobile_number . now());
    //         $user->save();

    //         return response()->json([
    //             'status' => 1,
    //             'message' => 'Success',
    //             'mobile_number' => $user->mobile_number,
    //             'api_token' => $user->api_token,
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => 0,
    //         'message' => 'OTP not match',
    //     ]);
    // }


    // public function login(Request $request)
    // {
    //     $user = userslogin::where('mobile_number', $request->mobile_number)->first();
    //     if (!$user) {
    //         $user = userslogin::create([
    //             'mobile_number' => $request->mobile_number,
    //             'otp' => rand(100000, 999999),
    //         ]);
    //     } else {
    //         $user->otp = rand(100000, 999999);
    //         $user->save();
    //     }

    //     // Simulate sending OTP via SMS (in production, integrate with an SMS service)
    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'Success',
    //         'is_number_verify' => $user->is_number_verify,
    //     ]);
    // }

    // public function verifyOtp(Request $request)
    // {
    //     $user = userslogin::where('mobile_number', $request->mobile_number)
    //         ->where('otp', $request->otp)
    //         ->first();

    //     if ($user) {
    //         // Check if the OTP has expired
    //         if (now()->greaterThan($user->otp_expires_at)) {
    //             return response()->json([
    //                 'status' => 0,
    //                 'message' => 'OTP has expired',
    //             ]);
    //         }

    //         $user->is_number_verify = 1;
    //         $user->api_token = Hash::make($request->mobile_number . now());
    //         $user->save();

    //         return response()->json([
    //             'status' => 1,
    //             'message' => 'Success',
    //             'mobile_number' => $user->mobile_number,
    //             'api_token' => $user->api_token,
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => 0,
    //         'message' => 'OTP not match',
    //     ]);
    // }
}
