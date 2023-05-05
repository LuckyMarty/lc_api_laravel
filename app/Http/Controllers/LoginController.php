<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return response()->json([
            'success'   => true,
            'name'      =>  'Jonathan'
        ]);
    }

    public function verification(
        string $email,
        string $password,
        string $secrete_key
    ) {
        if ($secrete_key === 'TYgTBvsqXOSO6Vx3YMlbJUl8nM3uJJiFoIEjvKpSHpdVUrAdbD') {

            if (User::whereEmail($email)) {
                $user = json_decode(User::whereEmail($email)->get(), true);

                if (Hash::check($password, $user[0]['password'])) {
                    return response()->json([
                        'success'   => true,
                        'name'      =>  $user[0]['name'],
                        'email'      =>  $user[0]['email'],
                        'password'      =>  $user[0]['password'],
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
