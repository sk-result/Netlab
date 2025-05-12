<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function index()
    {
        return response()->json(Pendaftaran::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'nim' => 'required|unique:pendaftarans,nim',
            'email' => 'required|email|unique:pendaftarans,email',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama_lengkap', 'nim', 'email', 'no_hp', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'tanggal_daftar'
        ]);
        $data['tanggal_daftar'] = now();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pendaftaran', 'public');
        }

        $pendaftaran = Pendaftaran::create($data);

        return response()->json([
            'message' => 'Pendaftaran berhasil dibuat',
            'data' => $pendaftaran
        ], 201);
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            return response()->json(['message' => 'Data pendaftaran tidak ditemukan'], 404);
        }

        return response()->json($pendaftaran, 200);
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            return response()->json(['message' => 'Data pendaftaran tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_lengkap' => 'required|string',
            'nim' => 'required|unique:pendaftarans,nim,' . $id,
            'email' => 'required|email|unique:pendaftarans,email,' . $id,
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pendaftaran->nama_lengkap = $request->nama_lengkap;
        $pendaftaran->nim = $request->nim;
        $pendaftaran->email = $request->email;
        $pendaftaran->no_hp = $request->no_hp;
        $pendaftaran->alamat = $request->alamat;
        $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
        $pendaftaran->jenis_kelamin = $request->jenis_kelamin;

        if ($request->hasFile('image')) {
            $pendaftaran->image = $request->file('image')->store('pendaftaran', 'public');
        }

        $pendaftaran->save();

        return response()->json([
            'message' => 'Pendaftaran berhasil diperbarui',
            'data' => $pendaftaran
        ], 200);
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            return response()->json(['message' => 'Data pendaftaran tidak ditemukan'], 404);
        }

        $pendaftaran->delete();

        return response()->json(['message' => 'Pendaftaran berhasil dihapus'], 200);
    }
}
