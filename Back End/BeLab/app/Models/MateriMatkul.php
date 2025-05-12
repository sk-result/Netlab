<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriMatkul extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'bab', 'description', 'file_pdf', 'category_id'];

    public function category()
    {
        return $this->belongsTo(MatkulCategory::class, 'category_id');
    }
}
