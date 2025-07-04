<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Photographer;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
        ]);

        if (!$request->has("isPhotographer")){
 $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dni' => $request->dni,
            'password' => Hash::make($request->password),
            
        ]);
        
        Auth::login($user);
        }else{
            $user = Photographer::create([
            'name' => $request->name,
            'email' => $request->email,
            'cif' => $request->cif,
            'password' => Hash::make($request->password),
        ]);
        Auth::guard('photographer')->login($user);
        }
       

        event(new Registered($user));


        return redirect(route('dashboard', absolute: false));
    }
}
