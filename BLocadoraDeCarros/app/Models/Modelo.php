<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = ['nome','imagem','numero_portas','lugares','air_bag','abs','marca_id'];

    public function rules()
    {
        return [
            'nome'   => "bail|required|max:50|unique:modelos,nome,$this->id",
            'imagem' => 'bail|required|image|mimes:png|max:100',
            'numero_portas' => 'bail|required|integer|digits_between:1,5',
            'lugares'       => 'bail|required|integer|digits_between:1,13',
            'air_bag'       => 'bail|required|bollean',
            'abs'           => 'bail|required|bollean',
            'marca_id'      => 'bail|required|exists:marcas,id',
        ];
    }

    public function feedback()
    {
        return [
            'required'    => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome da marca já existe',
            'nome.max'    => 'O nome pode ter no máximo 50 caracteres',
            'image.max'  => 'A image pode ter no máximo 100 caracteres',
            'image.mimes'=> 'A image só pode ser do tipo pnj.',
        ];
    }

    public function marca()
    {
        //UM modelo PERTENCE a UMA marca
        return $this->belongsTo(Marca::class);
    }

    public function carro()
    {
        //UM modelo POSSUI MUITOS carros
        return $this->hasMany(Carro::class);
    }
}
