<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $customer = Customer::where(
            'phone_number',
            $request->phone_number
        )->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return response()->json([
                'message' => 'Invalid phone number or password'
            ], 401);
        }

        $token = $customer->createToken('login-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function me()
    {
        return response()->json([
            'customer' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}