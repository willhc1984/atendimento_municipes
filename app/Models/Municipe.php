<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipe extends Model
{
    use HasFactory;

    protected $table = 'municipes';

    protected $fillable = ['nome', 'documento', 'telefone', 'bairro'];

    //Criar relacionamento 1:N
    public function atendimento(){
        return $this->hasMany(Atendimento::class);
    }
}
