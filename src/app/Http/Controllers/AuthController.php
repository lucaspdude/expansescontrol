<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



use App\User;
use App\Categoria;


use App\Mail\WelcomeMail;
use App\Mail\WelcomeLojaMail;
use App\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Mail;

use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;

class AuthController extends Controller
{


public $loginAfterSignUp = true;
public $successStatus = 200;
use SendsPasswordResetEmails;

public function registroUsuario(Request $request){


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
        'nome' => 'required',
        'email' => 'required|unique:users|email',
        'senha' => 'required|min:8',
        'confirme-senha' => 'sometimes|same:senha',
        'datanascimento' => 'required'
    ];


    $validator = Validator::make($request->all(), $regras, $mensagens);

    if($validator->fails()){
        return response()->json(['erro'=>$validator->errors()], 401);
    }
    $tipo = "usuario";

    $usuario = User::create([
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
        'tipo' => "usuario"
    ]);

    $usuario->assignRole('Usuario');




    // Mail::to($usuario->email)->send(new WelcomeMail($usuario));

    $token = auth()->login($usuario);
    return $this->respondWithToken($token, $usuario);
}



    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'password']);


      if (!$token = auth()->attempt($credentials)) {
        return response()->json(['erro' => 'Problemas ao fazer login, confira os dados'], 401);
      }

      $usuario = auth()->user();



        return $this->respondWithToken($token, $usuario);


    }



public function getAuthUser(Request $request)
    {
        return response()->json(auth()->user());

    }
public function logout(Request $request) {
     if (auth()->user()) {
         return response()->json(['message'=>'Erro ao fazer logout']);
    }
    auth()->logout();
    return response()->json(['message', 'Logout feito com sucesso!']);
    }




    public function reset(Request $request){

        $request->validate([
            'email' => 'required|string|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return response()->json(['mensagem'=>'Não encontramos um usuário com o email informado'], 401);
        }
        $newPassword = Str::random(9);
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
            'token' => $newPassword
        ]);


        if($user && $passwordReset){

            $user->password = bcrypt($newPassword);
            $user->update();


            // Mail::to($user->email)->send(new ResetPasswordMail($user, $passwordReset));

            return response()->json(['mensagem'=>'A sua nova senha foi enviada por e-email', 'token'=>$passwordReset->token], $this->successStatus);
        }
    }


protected function respondWithToken($token, $usuario)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60,
        'usuario' => $usuario,
      ]);
    }







}
