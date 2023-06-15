<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'baby_name' => ['required', 'max:50'],
            'baby_birthdate' => ['required', 'date'],
            'mother_name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );

        
        $user = User::create($attributes);
        $months = ['Januari', 'Februari', 'Maret', 'April', 'May', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for ($i = 0; $i < 12; $i++) {  
            Posyandu::create([
                'user_id' => $user->id,
                'month' => $months[$i],
                'date' => null,
                'weight' => null,
                'height' => null,
                'age' => null,
                'immunization' => false,
                'vit_a' => false,
            ]);
        }

        Auth::login($user);
        return redirect('/dashboard');
    }
}
