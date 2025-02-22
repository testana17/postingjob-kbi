<?php
namespace App\Services\Auth\Register;

use App\Repositories\Auth\Register\RegisterRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterServiceImplement implements RegisterService
{
    protected $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        // Atur role default ke 'user'
        $data['role'] = 'user';

        // Enkripsi password sebelum menyimpan
        $data['password'] = Hash::make($data['password']);

        // Cek apakah email sudah terdaftar
        if ($this->registerRepository->findByEmail($data['email'])) {
            return redirect()->back()->with('error', 'Email sudah terdaftar!');
        }

        // Simpan pengguna baru
        $this->registerRepository->create($data);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
