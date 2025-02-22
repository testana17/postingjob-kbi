<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Jika pengguna ingin mengubah kata sandi, verifikasi current_password
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['error' => 'Password saat ini tidak sesuai.'], 403);
            }
            $user->password = Hash::make($request->new_password);
        }

        // Perbarui hanya data yang diberikan
        $user->fill(array_filter($validatedData));
        $user->save();

        return response()->json(['message' => 'Profil berhasil diperbarui.', 'user' => $user]);
    }
}
