<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function carros(){
        return $this->belongsToMany(Carro::class, 'locacao','cliente_id','carro_id')->withTimestamps();
    }
}
