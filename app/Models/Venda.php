<?php
require_once dirname(__DIR__).'/Conexao/Conexao.php';
class Venda
{
    private $idUsuario;
    private $idMoeda;
    private $quantidadeMoeda;
    private $precoMedio;
    private $precoVenda;
    private $lucro;
    private $lucroPorcentagem;
    private $data;
   
   
    public function findByUsuario()
    {
        $sql = "SELECT * FROM `venda` INNER JOIN moeda ON venda.id_moeda = moeda.id WHERE id_usuario = :idUsuario";
        $stmt = Conexao::prepare($sql);
        $stmt->bindValue(':idUsuario', $this->idUsuario);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findByIdUsuarioAndIdMoeda() 
    {
        $sql = "SELECT * FROM `aporte` WHERE id_usuario = :idUsuario AND id_moeda = :idMoeda";
        $stmt = Conexao::prepare($sql);
        $stmt->bindValue(':idMoeda', $this->idMoeda);
        $stmt->bindValue(':idUsuario', $this->idUsuario);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

  

    public function insert()
    {
        $query = "INSERT INTO `venda` (id_usuario, id_moeda, quantidade_moeda, preco_medio, preco_venda, lucro, lucro_porcentagem, data) 
                  VALUES (:idUsuario, :idMoeda, :quantidadeMoeda, :precoMedio, :precoVenda, :lucro, :lucroPorcentagem, :data)";

        $stmt = Conexao::prepare($query);
        $stmt->bindValue(':idUsuario', $this->idUsuario);
        $stmt->bindValue(':idMoeda', $this->idMoeda);
        $stmt->bindValue(':quantidadeMoeda', $this->quantidadeMoeda);
        $stmt->bindValue(':precoMedio', $this->precoMedio);
        $stmt->bindValue(':precoVenda', $this->precoVenda);
        $stmt->bindValue(':lucro', $this->lucro);
        $stmt->bindValue(':lucroPorcentagem', $this->lucroPorcentagem);
        $stmt->bindValue(':data', $this->data);

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