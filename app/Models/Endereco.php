<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = ['contato_id', 'cep', 'rua', 'numero', 'complemento', 'cidade', 'estado'];

    public function contato()
    {
        return $this->belongsTo(Contato::class);
    }
}