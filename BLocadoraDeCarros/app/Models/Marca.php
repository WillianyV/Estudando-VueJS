<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nome','image'];

    public static function saveImage($image, $description)
    {
        $folder = str_replace([' ', '-','\\','/',':','*','?','"','<','>','|','+','.',',',
        '@','#','$','&','=',';'], '_', mb_strtoupper($description, 'UTF-8'));
        $path   = "images/marcas/$folder";
        return $image->store($path, 'public');
    }

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

}
