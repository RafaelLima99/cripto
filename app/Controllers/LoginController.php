<?php

require_once dirname(__DIR__)."/Models/Usuario.php";


class LoginController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
      
    }

    public function logar($dadosLogin)
    {

        $this->usuarioModel->__set('email', $dadosLogin['email']);
        $resultado = $this->usuarioModel->findLogin();
       
        if($resultado != ''){
            if( password_verify($dadosLogin['senha'], $resultado->senha)){

                session_start();
                $_SESSION['userLogado'] = true;
                $_SESSION['idUsuario'] = $resultado->id;
                $_SESSION['nomeUsuario'] = $resultado->nome;
                
                header('Location: ../../index.php');
            }else{
                //não logou
                header('Location: ../../login.php');
            }
        }else{
          //não logou
          header('Location: ../../login.php');
        }
    }
}

