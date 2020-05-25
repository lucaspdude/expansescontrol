<?php

namespace App\Http\Controllers\admin;

use App\Categoria;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriasResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoriasResource::collection(Categoria::withTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensagens = [
            'descricao.required' => 'Informe uma descrição para a categoria',
        ];

        $regras = [
            'descricao' => 'required',
        ];


        $validator = Validator::make($request->all(), $regras, $mensagens);

        if($validator->fails()){
            return response()->json(['erro'=>$validator->errors()->first()], 401);
        }

        $categoria = new Categoria();
        $categoria->descricao = $request->descricao;
        $categoria->save();
        
        $objeto = new CategoriasResource($categoria);
        $message = "Categoria cadastrada com sucesso!";

        return response()->json(['objeto'=>$objeto, 'message'=>$message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);
        return new CategoriasResource($categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensagens = [
            'descricao.required' => 'Informe uma descrição para a categoria',
        ];

        $regras = [
            'descricao' => 'required',
        ];


        $validator = Validator::make($request->all(), $regras, $mensagens);

        if($validator->fails()){
            return response()->json(['erro'=>$validator->errors()->first()], 401);
        }

        $categoria = Categoria::find($id);
        $categoria->descricao = $request->descricao;
        $categoria->update();

        $objeto = new CategoriasResource($categoria);
        $message = "Categoria atualizada com sucesso!";

        return response()->json(['objeto'=>$objeto, 'message'=>$message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        $message = "Categoria desativada com sucesso!";

        return response()->json(['message'=>$message], 200);
    }

    public function restore($id){
        $categoria = Categoria::withTrashed()->where('id', $id)->first();
        $categoria->restore();
        $mensagem = "Categoria reativada com sucesso";
        return response()->json(['message'=>$mensagem], 200);
    }

    public function permanentDestroy($id){
        $categoria = Categoria::withTrashed()->where('id',$id)->first();
        $categoria->forceDelete();
        $mensagem = "Categoria removida permanentemente!";
        return response()->json(['message'=>$mensagem], 200);
    }
}
