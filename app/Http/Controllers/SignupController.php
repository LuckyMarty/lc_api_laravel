<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true
        ]);
    }

    private function user(
        string $firstname,
        string $lastname,
        string $email,
        string $password
    )
    {
    }
}
