<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged Out'
        ];
    }
    public function login(Request $request)
    {   
        // get form inputs
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]); 
        // check user email
        $user = User::where('email', $fields['email'])->first();

        // if email not found or wrong password
        if(!$user || !Hash::check($fields['password'], $user->password))
        {
            return [
                'message' => 'Wrong login details'
            ];
        }
        // create token
        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function register(Request $request)
    {   
        // get form inputs
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);
        // create user
        // $user = User::create($request->all());
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'address' => $fields['address'],
            'password' => bcrypt($fields['password'])
        ]);
        // create token
        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
