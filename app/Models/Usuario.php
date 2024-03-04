<?php
require_once dirname(__DIR__).'/Conexao/Conexao.php';
class Usuario
{   
    private $nome;
    private $email;
    private $senha;

    public function findLogin()
    {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = Conexao::prepare($sql);
        $stmt->bindValue(':email', $this->email);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function insert()
    {
        $query = "INSERT INTO `usuario` (nome, email, senha)
                  VALUES (:nome, :email, :senha)";

        $stmt = Conexao::prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
       
        return $stmt->execute();

    }


    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;

    }
}