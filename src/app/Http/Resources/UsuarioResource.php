<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'nome'=> $this->name,
            'email'=> $this->email,
            'senha'=> $this->password,
            'pais' => $this->pais,
            'estado' => $this->estado,
            'cidade' => $this->cidade,
            'rua' => $this->rua,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'cep' => $this->cep,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'telefone' => $this->telefone,
            'datanascimento' => $this->datanascimento,
            'newsletter' => $this->newsletter,
            'logincount' => $this->logincount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'roles' => $this->roles,
        ];
    }
}
