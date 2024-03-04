<?php
require_once dirname(__DIR__).'/Conexao/Conexao.php';
class Moeda
{
    private $moeda;
    private $codMoeda;
    private $linkLogo;
   
   
    public function findAll()
    {
        $sql = "SELECT * FROM `moeda` ORDER  BY id DESC";
        $stmt = Conexao::prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

  

    public function insert()
    {
        $query = "INSERT INTO `moeda` (moeda, cod_moeda_binance, link_logo) 
                  VALUES (:moeda, :codMoeda, :linkLogo)";

        $stmt = Conexao::prepare($query);
        $stmt->bindValue(':moeda', $this->moeda);
        $stmt->bindValue(':codMoeda', $this->codMoeda);
        $stmt->bindValue(':linkLogo', $this->linkLogo);
        
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