<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    protected $table = 'atendimento';

    protected $fillable = ['vereador', 'status', 'dataHora', 'municipe_id'];

    public $timestamps = false;

    //Criar relacionamento 1:N
    public function municipe(){
        return $this->belongsTo(Municipe::class);
    }

}
