<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vereador extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'vereador';

    protected $fillable = ['nome', 'ativo'];
}
