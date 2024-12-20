<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'mensaje'
    ];

    protected $rules = [
        'nombre' => 'required|string|max:100',
        'telefono' => 'required|string|max:20',
        'email' => 'nullable|email',
        'mensaje' => 'required',
    ];
}