<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index(
        Request $request
    ) {
        if ($request->input('key') === 'TYgTBvsqXOSO6Vx3YMlbJUl8nM3uJJiFoIEjvKpSHpdVUrAdbD') {
            $name       = $request->input('name');
            $email      = $request->input('email');
            $password   = $request->input('password');

            $errors = [];

            // Check if name is set
            if ($name === null) {
                $errors['name'] = 0;
            }

            // Check if email is set or if alrealdy exist
            if ($email === null) {
                $errors['email'] = 0;
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 2;
                } else {
                    if (User::whereEmail($email)->exists()) {
                        $errors['email'] = 1;
                    }
                }
            }

            // check if password
            if ($password === null) {
                $errors['password'] = 0;
            } else {
                if (strlen($password) <= 8) {
                    $errors['password'] = 3;
                }
            }

            if ($errors) {
                return response()->json([
                    'success'   =>  false,
                    'message'   =>  $errors
                ]);
            } else {
                
                $user = new User;
                $user->name = $name;
                $user->email = $email;
                $user->password = Hash::make($password);
                $user->save();

                return response()->json([
                    'success'   => true
                ]);
            }
        } else {
            return response()->json([
                'success'   => false,
                'message'      =>  "Access denied"
            ]);
        }

        /**
         * 1. Vérification de l'email en bdd
         * 2. Vérification du mdp
         * 3. Vérifier la longueur du USER → Assez long etc.
         * 4. Idem pour le mdp : Vérifier la longueur → Plus grand 8 ; Caractère spécial ...
         * 
         * Messages Erreurs (INT)
         * 0. Valeur vide
         * 1. Email exist déjà
         * 2. Email non valide
         * 3. Mdp pas assez complexe
         */
    }
}
