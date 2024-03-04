<?php

require_once dirname(__DIR__)."/Models/Aporte.php";
require_once dirname(__DIR__)."/Models/MoedaUsuario.php";

class AporteController
{
    private $aporteModel;
    private $moedaUsuarioModel;

    public function __construct()
    {
        $this->aporteModel = new Aporte();
        $this->moedaUsuarioModel = new MoedaUsuario();
      
    }

    public function getAportes()
    {
        
        $idUsuario = $_SESSION['idUsuario'];
        $this->aporteModel->__set('idUsuario', $idUsuario);

        return $this->aporteModel->findByUsuario();
    }
    

    public function criar($dadosAporte)
    {

        session_start();
        $idUsuario = $_SESSION['idUsuario'];

        $this->aporteModel->__set('idMoeda', $dadosAporte['idMoeda']);
        $this->aporteModel->__set('idUsuario', $idUsuario);
        $this->aporteModel->__set('precoMoedaCompra', $dadosAporte['precoMoedaCompra']);
        $this->aporteModel->__set('quantidadeDeMoedas', $dadosAporte['quantidadeDeMoedas']);
        $this->aporteModel->__set('valorAporte', $dadosAporte['valorAporte']);
        $this->aporteModel->__set('dataCompra', $dadosAporte['dataCompra']);
      
        $insert = $this->aporteModel->insert();

        $this->moedaUsuarioModel->__set('idMoeda', $dadosAporte['idMoeda']);
        $this->moedaUsuarioModel->__set('idUsuario', $idUsuario);

        $moedaUsuario = $this->moedaUsuarioModel->findMoedaAndUser();
        
        // só cadastra a moeda na tabela moeda_usuário se ela ainda não existir na tabela
        if($moedaUsuario == false){
            
            $this->moedaUsuarioModel->__set('precoMedio', $dadosAporte['precoMoedaCompra']);
            $this->moedaUsuarioModel->__set('valorTotalInvestido', $dadosAporte['valorAporte']);
            $this->moedaUsuarioModel->__set('quantidadeTotalMoeda', $dadosAporte['quantidadeDeMoedas']);

            $this->moedaUsuarioModel->insert();

        }else{

            $quantidadeTotalMoeda = $moedaUsuario->quantidade_total_moeda + $dadosAporte['quantidadeDeMoedas'];
            $valorTotalInvestido  = $moedaUsuario->valor_total_investido + $dadosAporte['valorAporte'];

            $precoMedio = $this->precoMedio($quantidadeTotalMoeda, $valorTotalInvestido);

            $this->moedaUsuarioModel->__set('precoMedio', $precoMedio);
            $this->moedaUsuarioModel->__set('valorTotalInvestido', $valorTotalInvestido);
            $this->moedaUsuarioModel->__set('quantidadeTotalMoeda', $quantidadeTotalMoeda);

            $this->moedaUsuarioModel->update();

        }

        if($insert){
            header('Location: ../../index.php');
        }else{
            echo "deu erro";
            
        }
    }


    public function precoMedio($quantidadeTotalMoeda, $valorTotalInvestido)
    {

        $precoMedio = $valorTotalInvestido / $quantidadeTotalMoeda;
        
        $precoMedioArredondado = round($precoMedio, 4);

        return $precoMedioArredondado;

    }   
}