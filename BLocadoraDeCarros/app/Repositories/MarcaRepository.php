<?php

namespace App\Repositories;

/**regras de negocio é bom aqui */

class MarcaRepository extends AbstractRepository
{

    public function getResultadoPaginado($numero_de_registro_por_paginas)
    {
        return $this->model->paginate($numero_de_registro_por_paginas);
    }

}
?>
