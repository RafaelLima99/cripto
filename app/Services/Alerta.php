<?php

class Alerta 
{
    public function __construct()
    {
        //inicia uma sessão caso ela ainda não exista
        if ( session_status() !== PHP_SESSION_ACTIVE ){
            session_start();
        }
    }
    public static function verificaAlertaErro()
    {
        if(isset($_SESSION['alerta'])){
          
           if($_SESSION['alerta']['type'] == 'erro'){
                return true;
           }else{
                return false;
           }
          
        }else{
            return false;
        }
    }

    public static function verificaAlertaSucesso()
    {
        if ( session_status() !== PHP_SESSION_ACTIVE ){
            session_start();
        }

        if(isset($_SESSION['alerta'])){
          
           if($_SESSION['alerta']['type'] == 'sucesso'){
                return true;
           }else{
                return false;
           }
          
        }else{
            return false;
        }
    }

    public static function mensagemAlerta()
    {
       
        if(isset($_SESSION['alerta'])){
          
            $alerta = $_SESSION['alerta'];

            unset($_SESSION['alerta']);
         
            return $alerta;
           
         }
    }
}