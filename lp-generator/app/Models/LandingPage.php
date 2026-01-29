<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $table = 'landing_pages';

    protected $fillable = [
        'nome',
        'responsavel',
        'gtag',
        'formulario',
        'conteudo',
    ];

    protected $casts = [
        'conteudo' => 'array',
    ];
}
