<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        // Validar y asignar otros datos del perfil
        $user->fill($request->validated());
    
        // Verificar si se subió una imagen
        if ($request->hasFile('image')) {
            // Validar y guardar la imagen
            $path = $request->file('image')->store('profile-images', 'public');
            
            // Asignar la ruta a la base de datos
            $request->user()->image = $path;
            $request->user()->save();
        }
    
        // Si el correo electrónico fue actualizado, invalidar la verificación de correo
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $request->user()->save();
    
        return redirect()->route('profile.edit')->with('status', 'profile-image-updated');
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
