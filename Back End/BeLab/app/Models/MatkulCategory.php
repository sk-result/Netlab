<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function MateriMatkul()
    {
        return $this->hasMany(MateriMatkul::class);
    }
}
