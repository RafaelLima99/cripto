<?php

class Login
{
    public static function verificaUsuarioEstaLogado()
    {
       
        if(!isset($_SESSION)){ 
            session_start(); 
        } 

        if(isset($_SESSION['userLogado']) && !empty($_SESSION['userLogado'])){
           return true;
        }else{
            return false;
        }
    }

    public static function sair()
    {
        session_start();
        unset($_SESSION['userLogado']);
        unset($_SESSION['idUsuario']);
        unset($_SESSION['nomeUsuario']);

        header('Location: ../../login.php');
    }
}