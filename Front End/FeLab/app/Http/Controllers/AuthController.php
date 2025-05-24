<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
    }

    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Gunakan try-catch untuk menangani kemungkinan error parsing atau request
        try {
            $response = Http::post("$this->baseUrl/api/login", [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $data = $response->json();

            // Cek apakah respons memiliki token dan user
            if (isset($data['token']) && isset($data['user'])) {
                session([
                    'token' => $data['token'],
                    'user' => $data['user'],
                ]);

                return redirect()->route('admin.dashboard')->with('success', $data['message'] ?? 'Login berhasil');
            }

            return back()->with('error', 'Login gagal: data tidak lengkap dari server.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $response = Http::post("$this->baseUrl/api/register", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil');
        }

        return back()->with('error', 'Pendaftaran gagal: ' . $response->body());
    }
}
