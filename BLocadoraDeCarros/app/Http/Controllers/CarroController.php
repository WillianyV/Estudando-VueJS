<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarroRequest;
use App\Models\Carro;
use App\Repositories\CarroRepository;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    // injeção do model
    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carroRepositorio = new CarroRepository($this->carro);

        if($request->has('atributos_modelos')){
            $atributos_modelos = "modelo:id,marca_id,$request->atributos_modelos";
            $carroRepositorio->selectAtributosRegistrosRelacionados($atributos_modelos);
        }else{
            $carroRepositorio->selectAtributosRegistrosRelacionados('modelo');
        }

        if($request->has('pesquisa')){
            $carroRepositorio->pesquisa($request->pesquisa);
        }

        if($request->has('atributos')){
            $carroRepositorio->selectAtributos($request->atributos);
        }

        $carros = $carroRepositorio->getResultado();

        return response()->json($carros, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarroRequest $request)
    {
        $carro = $this->carro->create($request->all());

        return response()->json([$carro], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carro = $this->carro->with('modelo')->find($id);
        if ($carro === null) {
            return response()->json(['erro' => 'Recurso pesquisando não existe.'], 404);
        }
        return response()->json($carro, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carro = $this->carro->find($id);
        if ($carro === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe.'], 404);
        }

        // preencher o objeto $marca com os dados enviados
        // se tiver algum que não foi ele não atualiza
        $carro->fill($request->all());

        if($request->method() === 'PATCH'){
            /**
             * quando quero atualizar só algumas coisas utiliza-se o PATCH,
             * quando quero atualizar todos os dados é PUT
             */
            $regrasDinamicas = array();
            foreach ($carro->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            // Validando os dados através do modelo
            $request->validate($regrasDinamicas);
        }else{
            // Validando os dados através do modelo
            $request->validate($carro->rules());
        }

        //atualiza se tiver ID, se não tiver cria um novo
        $carro->save();

        return response()->json($carro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carro = $this->carro->find($id);
        if ($carro === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe.'], 404);
        }

        $carro->delete();
        return response()->json(['msg' => 'O carro foi removido com sucesso.'], 200);
    }
}
