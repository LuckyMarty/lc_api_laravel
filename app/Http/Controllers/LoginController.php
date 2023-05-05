<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(
        Request $request
    )
    {
        if ($request->input('key') === 'TYgTBvsqXOSO6Vx3YMlbJUl8nM3uJJiFoIEjvKpSHpdVUrAdbD') {
            $email      = $request->input('email');
            $password   = $request->input('password');

            if (User::whereEmail($email)) {
                $user = json_decode(User::whereEmail($email)->get(), true);

                if (Hash::check($password, $user[0]['password'])) {
                    return response()->json([
                        'success'   => true,
                        'name'      =>  $user[0]['name'],
                        'email'      =>  $user[0]['email'],
                    ]);
                } else {
                    return response()->json([
                        'success'   => false,
                        'message'      =>  'Mot de passe incorrect'
                    ]);
                }
            } else {

                return response()->json([
                    'success'   => false,
                    'message'      =>  "Il n'y a aucun utilisateur ayant cette adresse email"
                ]);
            }
        } else {

            return response()->json([
                'success'   => false,
                'message'      =>  "Access denied"
            ]);
        }
    }
}
