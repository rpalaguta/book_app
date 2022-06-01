<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TokenController extends Controller
{
    public function getToken(Request $request): Response|array
    {
        $validation = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if ($validation->errors()->count() > 0) {
            return response(['errors' => $validation->errors()], 400);
        }

        /** @var User $user */
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['error' => 'Invalid credentials provided'], 400);
        }

        return [
            'token' => $user->createToken('login')->plainTextToken
        ];
    }
}
