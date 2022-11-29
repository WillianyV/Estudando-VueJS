<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModeloController extends Controller
{
    // injeção do model
    public function __construct(Modelo $modelo, Util $util)
    {
        $this->modelo   = $modelo;
        $this->util     = $util;
        $this->pathName = "modelos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = $this->modelo->all();
        return response()->json($modelos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // Gravar a foto e pegando o caminho onde ela foi salva.
        if ($request->file('imagem')) {
            $data['imagem'] = $this->util->saveImage($request->file('imagem'), $request->nome,$this->pathName);
        }
        $modelo = $this->modelo->create($data);
        return response()->json($modelo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $modelo = $this->modelo->find($id);
        if ($modelo === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($modelo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $modelo = $this->modelo->find($id);
        if ($modelo === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe.'], 404);
        }

        if($request->method() === 'PATCH'){
            /**
             * quando quero atualizar só algumas coisas utiliza-se o PATCH,
             * quando quero atualizar todos os dados é PUT
             */
            $regrasDinamicas = array();
            foreach ($modelo->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            // Validando os dados através do modelo
            $request->validate($regrasDinamicas, $modelo->feedback());
        }else{
            // Validando os dados através do modelo
            $request->validate($modelo->rules(), $modelo->feedback());
        }

        // preencher o objeto $modelo com os dados enviados
        // se tiver algum que não foi ele não atualiza
        $modelo->fill($request->all());

        //remove o arquivo antigo, caso um novo tenha sido enviado no request
        if ($request->file('imagem')) {
            //verificando se existia imagem anterior
            if ($modelo->imagem) {
                Storage::disk('public')->delete($modelo->imagem); //remove a imagem anterior
            }
            //salva nova imagem
            $modelo->imagem = $this->util->saveImage($request->file('imagem'), $request->modelo,$this->pathName);
        }

        //atualiza se tiver ID, se não tiver cria um novo
        $modelo->save();

        return response()->json($modelo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $modelo = $this->modelo->find($id);
        if ($modelo === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. Recurso pesquisado não existe.'], 404);
        }
        //verificando se existia imagem anterior
        if ($modelo->imagem) {
            Storage::disk('public')->delete($modelo->imagem); //remove a imagem anterior
        }
        $modelo->delete();
        return response()->json(['msg' => 'O modelo foi removido com sucesso!'], 200);
    }
}
