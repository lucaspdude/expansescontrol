<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;


class CategoriasController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();

        return response()->json(['categorias'=>$categorias], $this->successStatus);

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
            'descricao.required' => 'Informe o nome da categoria',
            'descricao.min' => 'O nome da categoria deve conter mais do que 3 caracteres'
        ];
        $regras = [
            'descricao' => 'required|min:3',
        ];

        $validator = Validator::make($request->all(), $regras, $mensagens);

        if($validator->fails()){
            return response()->json(['erro'=>$validator->errors()], 401);
        }

        $categoria = new Categoria();
        $categoria->descricao = $request->descricao;
        $categoria->slug = Str::slug($request->descricao);
        $categoria->save();

        $mensagem = "Categoria cadastrada com sucesso!";
        return response()->json(['categoria'=>$categoria, 'mensagem'=>$mensagem], $this->successStatus);
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

        return response()->json(['categoria'=>$categoria], $this->successStatus);
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
            'descricao.required' => 'Informe o nome da categoria',
            'descricao.min' => 'O nome da categoria deve conter mais do que 3 caracteres'
        ];
        $regras = [
            'descricao' => 'required|min:3',
        ];

        $validator = Validator::make($request->all(), $regras, $mensagens);

        if($validator->fails()){
            return response()->json(['erro'=>$validator->errors()], 401);
        }

        $categoria = Categoria::find($id);
        $categoria->descricao = $request->descricao;
        $categoria->slug = Str::slug($request->descricao);
        $categoria->save();

        $mensagem = "Categoria atualizada com sucesso!";
        return response()->json(['categoria'=>$categoria, 'mensagem'=>$mensagem], $this->successStatus);
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

        $success['mensagem'] = "Categoria removida com sucesso";

        return response()->json(['success'=>$success], $this->successStatus);
    }
}
