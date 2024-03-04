<?php
require_once dirname(__DIR__).'/Conexao/Conexao.php';
class MoedaUsuario
{
    private $idMoeda;
    private $idUsuario;
    private $precoMedio;
    private $valorTotalInvestido;
    private $quantidadeTotalMoeda;
   

    public function findByIdUser()
    {
        //$sql = "SELECT * FROM `moeda_usuario` WHERE id_usuario = :idUsuario ORDER  BY id DESC";
        $sql = "SELECT * FROM `moeda_usuario` INNER JOIN moeda on moeda_usuario.id_moeda = moeda.id WHERE id_usuario = :idUsuario";
        $stmt = Conexao::prepare($sql);
        $stmt->bindValue(':idUsuario', $this->idUsuario);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function findMoedaAndUser()
    {
        $query = "SELECT * FROM `moeda_usuario` WHERE id_moeda = :idMoeda AND id_usuario = :idUsuario";
        $stmt = Conexao::prepare($query);
        $stmt->bindValue(':idMoeda', $this->idMoeda);
        $stmt->bindValue(':idUsuario', $this->idUsuario);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
   
    public function insert()
    {
        $query = "INSERT INTO `moeda_usuario` (id_moeda, id_usuario, preco_medio, valor_total_investido, quantidade_total_moeda) 
                  VALUES (:idMoeda, :idUsuario, :precoMedio, :valorTotalInvestido, :quantidadeTotalMoeda)";

        $stmt = Conexao::prepare($query);
        $stmt->bindValue(':idMoeda', $this->idMoeda);
        $stmt->bindValue(':idUsuario', $this->idUsuario);
        $stmt->bindValue(':precoMedio', $this->precoMedio);
        $stmt->bindValue(':valorTotalInvestido', $this->valorTotalInvestido);
        $stmt->bindValue(':quantidadeTotalMoeda', $this->quantidadeTotalMoeda);
       
        return $stmt->execute();
        
    }

    public function update()
    {

        $query = "UPDATE moeda_usuario SET preco_medio = :precoMedio, valor_total_investido = :valorTotalInvestido,
                  quantidade_total_moeda = :quantidadeTotalMoeda WHERE id_moeda = :idMoeda AND id_usuario = :idUsuario";
                 
        $stmt = Conexao::prepare($query);
        $stmt->bindValue(':idMoeda', $this->idMoeda);
        $stmt->bindValue(':idUsuario', $this->idUsuario);
        $stmt->bindValue(':precoMedio', $this->precoMedio);
        $stmt->bindValue(':valorTotalInvestido', $this->valorTotalInvestido);
        $stmt->bindValue(':quantidadeTotalMoeda', $this->quantidadeTotalMoeda);

        return $stmt->execute();

    }

    public function updateQuantidadeMoedaEValorInvestido()
    {
        $query = "UPDATE moeda_usuario SET quantidade_total_moeda = :quantidadeTotalMoeda, valor_total_investido = :valorTotalInvestido WHERE id_moeda = :idMoeda AND id_usuario = :idUsuario";
                 
        $stmt = Conexao::prepare($query);
        $stmt->bindValue(':idMoeda', $this->idMoeda);
        $stmt->bindValue(':idUsuario', $this->idUsuario);
        $stmt->bindValue(':valorTotalInvestido', $this->valorTotalInvestido);
        $stmt->bindValue(':quantidadeTotalMoeda', $this->quantidadeTotalMoeda);

        return $stmt->execute();
    }

    
    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}