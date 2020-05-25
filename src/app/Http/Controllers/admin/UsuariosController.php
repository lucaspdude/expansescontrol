<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarioResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UsuarioResource::collection(User::paginate(100));
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
            'nome.required' => 'Informe o seu nome',
            'email.required' => 'Informe um endereço de e-mail',
            'email.unique' => 'Este endereço de e-mail já está em uso',
            'email.email' => 'Informe um endereço de e-mail válido',
            'senha.required' => "Informe uma senha",
            'senha.min' => "A senha deve conter pelo menos 8 caracteres",
            'confirme-senha.sometimes' => 'Repita a senha',
            'confirme-senha.same' => 'As senhas não são iguais',
            'data-nascimento.required' => 'Preencha a data de nascimento',
            'funcao.required' => 'Preencha a função do usuário'
        ];

        $regras = [
            'nome' => 'required',
            'email' => 'required|unique:users|email',
            'senha' => 'required|min:8',
            'confirme-senha' => 'sometimes|same:senha',
            'datanascimento' => 'required',
            'funcao' => 'required'
        ];


        $validator = Validator::make($request->all(), $regras, $mensagens);

        if($validator->fails()){
            return response()->json(['erro'=>$validator->errors()->first()], 401);
        }

        $user = User::create([
            'name' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->senha),
            'pais' => $request->pais,
            'estado' => $request->estado,
            'cidade' => $request->cidade,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
            'telefone' => $request->telefone,
            'newsletter' => $request->newsletter,
            'datanascimento' => $request->datanascimento,
        ]);
        $user->syncRoles($request->funcao);
        $objeto = new UsuarioResource($user);
        $message = "Usuário cadastrado com sucesso!";

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
        $user = User::find($id);
        return new UsuarioResource($user);
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
            'email' => 'sometimes|email|unique:users,id,user:id',
            'senha' => 'nullable|min:8',
            'confirme-senha' => 'sometimes|same:senha',
            'datanascimento' => 'sometimes',
            'tipo' => 'sometimes'
        ];


        $validator = Validator::make($request->all(), $regras, $mensagens);

        if($validator->fails()){
            return response()->json(['erro'=>$validator->errors()->first()], 401);
        }

            $user = User::find($id);
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->password = bcrypt($request->senha);
            $user->pais = $request->pais;
            $user->estado = $request->estado;
            $user->cidade = $request->cidade;
            $user->rua = $request->rua;
            $user->numero = $request->numero;
            $user->bairro = $request->bairro;
            $user->cep = $request->cep;
            $user->cpf = $request->cpf;
            $user->cnpj = $request->cnpj;
            $user->telefone = $request->telefone;
            $user->newsletter = $request->newsletter;
            $user->datanascimento = $request->datanascimento;
            $user->update();
            $user->syncRoles($request->role);
            $objeto = new UsuarioResource($user);
            $message = "Dados atualizados com sucesso!";

            // if($request->has('funcao')){
            //     return response()->json($request->funcao)
            // }
            $user->syncRoles($request->funcao);

            return response()->json(['objeto'=>$objeto, 'message'=>$message]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['mensagem'=>"Usuario desativado com sucesso!"], 200);
    }

    public function restore($id){
        $user = User::withTrashed()->where('id', $id)->first();
        $user->restore();
        $mensagem = "Usuário reativado com sucesso";
        return response()->json(['message'=>$mensagem], $this->successStatus);
    }

    public function permanentDestroy($id){
        $user = User::withTrashed()->where('id',$id)->first();
        $user->forceDelete();
        $mensagem = "Usuário removido permanentemente!";
        return response()->json(['message'=>$mensagem], $this->successStatus);
    }
}
