<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileUserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
    
        // Jika pengguna ingin mengubah password, verifikasi current_password
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }
            $user->password = Hash::make($request->new_password);
        }
    
        // Perbarui nama jika diberikan
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
    
        // Perbarui email jika diberikan
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
    
        // Simpan perubahan
        $user->save();
    
        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
