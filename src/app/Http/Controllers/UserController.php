<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();

        return response()->json($usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);

        return response()->json($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'nome.required' => 'Informe o seu nome',
            'email.required' => 'Informe um endereço de e-mail',
            'email.unique' => 'Este endereço de e-mail já está em uso',
            'email.email' => 'Informe um endereço de e-mail válido',
            'senha.required' => "Informe uma senha",
            'senha.min' => "A senha deve conter pelo menos 8 caracteres",
            'confirme-senha.sometimes' => 'Repita a senha',
            'confirme-senha.same' => 'As senhas não são iguais',
            'data-nascimento.required' => 'Preencha a data de nascimento'
        ];

        $regras = [
            'nome' => 'sometimes',
            'email' => 'sometimes|unique:users|email',
            'senha' => 'sometimes|min:8',
            'confirme-senha' => 'sometimes|same:senha',
            'datanascimento' => 'sometimes',
            'tipo' => 'sometimes'
        ];


        $validator = Validator::make($request->all(), $regras, $mensagens);

        if($validator->fails()){
            return response()->json(['erro'=>$validator->errors()], 401);
        }

        $usuario = User::find($id);
            $usuario->name = $request->nome;
            $usuario->email = $request->nome;
            $usuario->password = bcrypt($request->senha);
            $usuario->pais = $request->pais;
            $usuario->estado = $request->estado;
            $usuario->cidade = $request->cidade;
            $usuario->rua = $request->rua;
            $usuario->numero = $request->numero;
            $usuario->bairro = $request->bairro;
            $usuario->cep = $request->cep;
            $usuario->cpf = $request->cpf;
            $usuario->cnpj = $request->cnpj;
            $usuario->telefone = $request->telefone;
            $usuario->newsletter = $request->newsletter;
            $usuario->datanascimento = $request->datanascimento;
            $usuario->tipo = "usuario";

        $usuario->update();

        $success['data'] = $usuario;
        $success['mensagem'] = "Usuário atualizado com sucesso!";

        return response()->json(['success'=>$success], $this->successStatus);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        $success['mensagem'] = "Usuário removido com sucesso";

        return response()->json(['success'=>$success], $this->successStatus);
    }


    public function profilepic($id, Request $request){
        $usuario = User::with('media')->find($id);

        if($usuario->hasMedia('profilepic')){
            $usuario->clearMediaCollection('profilepic');
        }
        $usuario->addMedia($request->arquivo)->toMediaCollection('profilepic');

        $success['mensagem'] = "Foto de perfil atualizada com sucesso!";
        $success['data'] = $usuario;

        return response()->json(['success'=>$success], $this->successStatus);
    }
}
