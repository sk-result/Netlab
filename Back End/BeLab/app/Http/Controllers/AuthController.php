<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'nullable|in:super_admin,admin,user',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Registrasi berhasil',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ], 201);
    }


    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        // Cek user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Validasi password atau user tidak ditemukan
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Buat token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Response JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user->only(['id', 'name', 'email', 'role']) // hanya field penting
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }

    // ✅ Ambil data user yang sedang login
    public function getUser(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    // ✅ Update data user
    public function updateUser(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6',
            'role' => 'sometimes|in:super_admin,admin,user'
        ]);

        if ($request->filled('name')) $user->name = $request->name;
        if ($request->filled('email')) $user->email = $request->email;
        if ($request->filled('password')) $user->password = Hash::make($request->password);
        if ($request->filled('role')) $user->role = $request->role;

        $user->save();

        return response()->json([
            'message' => 'Data user berhasil diperbarui',
            'user' => $user
        ]);
    }

    // ✅ Hapus user
    public function deleteUser(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete(); // Hapus semua token
        $user->delete();

        return response()->json([
            'message' => 'Akun user berhasil dihapus'
        ]);
    }
}
