<?php

class Conexao 
{
    private static $host	= "localhost";
    private static $base	= "cripto";
    private static $usuario = "root";
    private static $senha	= '';


    // private static $host	= "72.52.161.99";
    // private static $base	= "grupofapservtest_premiapao_sorteio";
    // private static $usuario = "grupofap_main";
    // private static $senha	= 'Jkdjfkld50827!';

    public static $conexao;

    public static function conecta()
    {

        try{
            return self::$conexao = new PDO('mysql:host='.self::$host.';dbname='.self::$base , self::$usuario, self::$senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }catch(PDOException $erro){
            echo 'Erro de conexão com o banco de dados: '.$erro->getMessage();
        }

    }

    public static function prepare($sql)
    {
        return self::conecta()->prepare($sql);
    }
}