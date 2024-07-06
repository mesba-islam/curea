<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class DoctorController extends Controller
{
    public function create(): View
    {
        return view('auth.register-doctor');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'license_number' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
        ]);

        // Create the doctor's profile
        Doctor::create([
            'user_id' => $user->id,
            'department' => $request->department,
            'license_number' => $request->license_number,
            'mobile' => $request->mobile,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }



}
