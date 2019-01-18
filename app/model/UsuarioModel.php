<?php
namespace app\model;

use core\mvc\Model;

class UsuarioModel extends Model
{

    private $nome;
    private $cpf;
    private $email;
    private $telefone;
    private $senha;

    public function __construct(
        $id = null,
        $nome = null,
        $cpf = null,
        $email = null,
        $telefone = null,
        $senha = null
     
    )
    {
        parent::__construct($id);
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->senha = $senha;       
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function show() {

    }   

}