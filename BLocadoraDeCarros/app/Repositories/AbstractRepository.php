<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectAtributosRegistrosRelacionados($atributos)
    {
        $this->model = $this->model->with($atributos);
    }

    public function pesquisa($pesquisas)
    {
        $filtros = explode(';', $pesquisas);
        foreach ($filtros as $filtro) {
            $pesquisa = explode(':', $filtro);
            $this->model = $this->model->where($pesquisa[0],$pesquisa[1],$pesquisa[2]);
        }
    }

    public function selectAtributos($atributos)
    {
        $this->model = $this->model->selectRaw($atributos);
    }

    public function getResultado()
    {
        return $this->model->get();
    }

    public function saveImage($image, $description, $namePath)
    {
        $folder = str_replace([' ', '-','\\','/',':','*','?','"','<','>','|','+','.',',',
        '@','#','$','&','=',';'], '_', mb_strtoupper($description, 'UTF-8'));
        $path   = "images/$namePath/$folder";
        return $image->store($path, 'public');
    }
}
?>
