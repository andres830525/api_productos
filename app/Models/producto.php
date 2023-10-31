<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{

    protected $fillable  = [
        'titulo',
        'descripcion',
        'imagen',
        'precio',
    ];
    use HasFactory;
}
