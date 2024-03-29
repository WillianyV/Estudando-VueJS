<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nome','image'];

    public function rules()
    {
        return [
            'nome'   => "bail|required|max:50|unique:marcas,nome,$this->id",
            'image' => 'bail|required|image|mimes:png|max:100',
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

    public function modelos()
    {
        //UMA marca POSSUI MUITOS modelos
        return $this->hasMany(Modelo::class);
    }

}
