<?php

namespace App\Http\Controllers\Api;

use App\Filament\Resources\Customers\CustomerResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer; 

class CustomerAuthController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount('customer')->get();
        return CustomerResource::collection($customers);
    }

    public function show(Customer $customers) //model binding
    {
        $customers->load(['name', 'email', 'phone', 'password']);
        return new CustomerResource($customers);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
        ]);

        // model Customer, bukan controller
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //pastikan Customer model pakai HasApiTokens
        $token = $customer->createToken('customer_token')->plainTextToken;

        return response()->json([
            'message' => 'Register success',
            'customer' => $customer,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if (! $customer || ! Hash::check($request->password, $customer->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $customer->createToken('customer_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'customer' => $customer,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
