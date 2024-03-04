<?php
require_once dirname(__DIR__).'/Conexao/Conexao.php';
class Aporte
{
    private $idMoeda;
    private $idUsuario;
    private $precoMoedaCompra;
    private $quantidadeDeMoedas;
    private $valorAporte;
    private $dataCompra;
   
   
    public function findByUsuario()
    {
        $sql = "SELECT * FROM `aporte` INNER JOIN moeda ON aporte.id_moeda = moeda.id WHERE id_usuario = :idUsuario";
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
        $query = "INSERT INTO `aporte` (id_moeda, id_usuario, preco_moeda_compra, quantidade_moeda, valor_aporte, data_aporte) 
                  VALUES (:idMoeda, :idUsuario, :precoMoedaCompra, :quantidadeDeMoedas, :valorAporte, :dataCompra)";

        $stmt = Conexao::prepare($query);
        $stmt->bindValue(':idMoeda', $this->idMoeda);
        $stmt->bindValue(':idUsuario', $this->idUsuario);
        $stmt->bindValue(':precoMoedaCompra', $this->precoMoedaCompra);
        $stmt->bindValue(':quantidadeDeMoedas', $this->quantidadeDeMoedas);
        $stmt->bindValue(':valorAporte', $this->valorAporte);
        $stmt->bindValue(':dataCompra', $this->dataCompra);

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