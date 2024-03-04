<?php

require_once dirname(__DIR__)."/Models/Moeda.php";

class MoedaController
{
    private $moedaModel;

    public function __construct()
    {
        $this->moedaModel = new Moeda();
      
    }

    public function getMoedas()
    {
        return $this->moedaModel->findAll();
    }
    
    public function criar($dadosMoeda)
    {
        $this->moedaModel->__set('moeda', $dadosMoeda['moeda']);
        $this->moedaModel->__set('codMoeda', $dadosMoeda['codMoeda']);
        $this->moedaModel->__set('linkLogo', $dadosMoeda['linkLogo']);
      
        $insert = $this->moedaModel->insert();

        if($insert){
            header('Location: ../../index.php');
        }else{
            echo "deu erro";
            //header('Location: ../../criar_conta.php');
        }
    }
}