<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequest;
use App\Models\Marca;
use App\Models\Util;
use App\Repositories\MarcaRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    public function __construct(Marca $marca, Util $util)
    {
        $this->marca    = $marca;
        $this->util     = $util;
        $this->pathName = "marcas";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $marcaRepositorio = new MarcaRepository($this->marca);

        if($request->has('atributos_modelos')){
            $atributos_modelos = "modelos:id,marca_id,$request->atributos_modelos";
            $marcaRepositorio->selectAtributosRegistrosRelacionados($atributos_modelos);
        }else{
            $marcaRepositorio->selectAtributosRegistrosRelacionados('modelos');
        }

        if($request->has('pesquisa')){
            $marcaRepositorio->pesquisa($request->pesquisa);
        }

        if($request->has('atributos')){
            $marcaRepositorio->selectAtributos($request->atributos);
        }

        $marcas = $marcaRepositorio->getResultadoPaginado(4);

        return response()->json($marcas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarcaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarcaRequest $request)
    {
        $data = $request->all();
        // Gravar a foto e pegando o caminho onde ela foi salva.
        if ($request->file('image')) {
            $marcaRepositorio = new MarcaRepository($this->modelo);
            $data['image'] = $marcaRepositorio->saveImage($request->file('image'), $request->nome,$this->pathName);
        }
        $marca = $this->marca->create($data);
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $marca = $this->marca->find($id);
        if ($marca === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($marca, 200);
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
        $marca = $this->marca->find($id);
        if ($marca === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe.'], 404);
        }

        if($request->method() === 'PATCH'){
            /**
             * quando quero atualizar só algumas coisas utiliza-se o PATCH,
             * quando quero atualizar todos os dados é PUT
             */
            $regrasDinamicas = array();
            foreach ($marca->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            // Validando os dados através do modelo
            $request->validate($regrasDinamicas, $marca->feedback());
        }else{
            // Validando os dados através do modelo
            $request->validate($marca->rules(), $marca->feedback());
        }

        // preencher o objeto $marca com os dados enviados
        // se tiver algum que não foi ele não atualiza
        $marca->fill($request->all());

        //remove o arquivo antigo, caso um novo tenha sido enviado no request
        if ($request->file('image')) {
            //verificando se existia imagem anterior
            if ($marca->image) {
                Storage::disk('public')->delete($marca->image); //remove a imagem anterior
            }
            //salva nova imagem
            $marcaRepositorio = new MarcaRepository($this->marca);
            $marca->image = $marcaRepositorio->saveImage($request->file('image'), $request->marca,$this->pathName);
        }

        //atualiza se tiver ID, se não tiver cria um novo
        $marca->save();

        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $marca = $this->marca->find($id);
        if ($marca === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. Recurso pesquisado não existe.'], 404);
        }
        //verificando se existia imagem anterior
        if ($marca->image) {
            Storage::disk('public')->delete($marca->image); //remove a imagem anterior
        }
        $marca->delete();
        return response()->json(['msg' => 'A marca foi removida com sucesso!'], 200);
    }
}
