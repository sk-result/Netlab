<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'nim',
        'email',
        'no_hp',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'image',
    ];
}
