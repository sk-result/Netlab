<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            'tanggal_lahir' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Mapping nama bulan Indonesia ke Inggris
        $bulanIndonesia = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        try {
            $tanggalInput = $request->tanggal_lahir;
            foreach ($bulanIndonesia as $indo => $eng) {
                if (Str::contains($tanggalInput, $indo)) {
                    $tanggalInput = str_replace($indo, $eng, $tanggalInput);
                    break;
                }
            }

            $tanggalFormatted = Carbon::createFromFormat('d-F-Y', $tanggalInput)->format('Y-m-d');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Format tanggal lahir tidak valid. Gunakan format: 10-Desember-2004'
            ], 422);
        }

        $data = $request->only([
            'nama_lengkap',
            'nim',
            'email',
            'no_hp',
            'alamat',
            'jenis_kelamin'
        ]);
        $data['tanggal_lahir'] = $tanggalFormatted;

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
            'tanggal_lahir' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Format ulang tanggal
        $bulanIndonesia = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        try {
            $tanggalInput = $request->tanggal_lahir;
            foreach ($bulanIndonesia as $indo => $eng) {
                if (Str::contains($tanggalInput, $indo)) {
                    $tanggalInput = str_replace($indo, $eng, $tanggalInput);
                    break;
                }
            }

            $tanggalFormatted = Carbon::createFromFormat('d-F-Y', $tanggalInput)->format('Y-m-d');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Format tanggal lahir tidak valid. Gunakan format: 01-Januari-2001'
            ], 422);
        }

        $pendaftaran->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nim' => $request->nim,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $tanggalFormatted,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        if ($request->hasFile('image')) {
            $pendaftaran->image = $request->file('image')->store('pendaftaran', 'public');
            $pendaftaran->save();
        }

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
