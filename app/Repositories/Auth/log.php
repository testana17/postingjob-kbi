//     public function login(array $credentials): RedirectResponse
// {
//     try {
//         if (!$token = JWTAuth::attempt($credentials)) {
//             return redirect()->back()
//                 ->withInput()
//                 ->withErrors(['email' => 'Email atau password salah.']);
//         }
        
//         // Simpan token di session
//         session(['jwt_token' => $token]);
//         Log::info('Token disimpan di session:', ['token' => $token]);

//         $user = auth()->user();
//         return redirect()->to(
//             $user->role === 'company' ? route('company.dashboard') : route('user.dashboard')
//         )->with('success', 'Login berhasil');
        
//     } catch (JWTException $e) {
//         return redirect()->back()
//             ->withInput()
//             ->withErrors(['email' => 'Terjadi kesalahan saat login.']);
//     }
// }
    


//     public function getUser()
//     {
//         try {
//             if (!$user = JWTAuth::parseToken()->authenticate()) {
//                 return redirect()->route('login')->withErrors(['error' => 'User tidak ditemukan']);
//             }
//         } catch (JWTException $e) {
//             return redirect()->route('login')->withErrors(['error' => 'Token tidak valid']);
//         }

//         return view('dashboard', compact('user'));
//     }

//     public function logout(): RedirectResponse
//     {
//         JWTAuth::invalidate(JWTAuth::getToken());

//         // Hapus token dari session
//         session()->forget('jwt_token');

//         return redirect()->route('login')->with('success', 'Berhasil logout');
//     }