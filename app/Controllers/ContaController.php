<?php

require_once dirname(__DIR__)."/Models/Usuario.php";

class ContaController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
      
    }
   
    public function criar($dadosConta)
    {
        $this->usuarioModel->__set('nome', $dadosConta['nome']);
        $this->usuarioModel->__set('email', $dadosConta['email']);
        $this->usuarioModel->__set('senha', password_hash($dadosConta['senha'], PASSWORD_DEFAULT));

        $insert = $this->usuarioModel->insert();

        if($insert){
            header('Location: ../../index.php');
        }else{
            
            header('Location: ../../criar_conta.php');
        }
    }
}