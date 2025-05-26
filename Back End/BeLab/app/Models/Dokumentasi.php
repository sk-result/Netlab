<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumentasi extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'description', 'image'];
    public function Dokumentasi()
    {
        return $this->belongsTo(CategoryDokumentasi::class, 'category_id');
    }
}
