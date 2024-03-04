<?php

require_once dirname(__DIR__)."/Models/Venda.php";
require_once dirname(__DIR__)."/Models/MoedaUsuario.php";

class VendaController
{
    private $vendaModel;
    private $moedaUsuarioModel;

    public function __construct()
    {
        $this->vendaModel = new Venda();
        $this->moedaUsuarioModel = new MoedaUsuario();
      
    }

    public function getVendas()
    {
        
        $idUsuario = $_SESSION['idUsuario'];
        $this->vendaModel->__set('idUsuario', $idUsuario);

        $vendas = $this->vendaModel->findByUsuario();

        $lucroTotal = 0;

        foreach ($vendas as $key => $venda) {
            $lucroTotal += $venda->lucro;
        }

        return ['vendas' => $vendas, 'lucroTotal' => $lucroTotal];
    }
    

    public function criar($dadosVenda)
    {
        
        session_start();
        $idUsuario = $_SESSION['idUsuario'];

        $this->moedaUsuarioModel->__set('idUsuario', $idUsuario);
        $this->moedaUsuarioModel->__set('idMoeda', $dadosVenda['idMoeda']);

        //dados da moeda que foi vendida
        $moedaUsuario = $this->moedaUsuarioModel->findMoedaAndUser();

        $vendaMaiorQueQuantidadeComprada = $this->vericaVendaMaiorQueQuantidadeComprada($dadosVenda['quantidadeMoeda'], $moedaUsuario->quantidade_total_moeda);

        if($vendaMaiorQueQuantidadeComprada){
            header('Location: ../../cadastrar_venda.php?erro=venda-maior-que-quantidade-comprada');
            die;
        }

        $quantidadeTotalDeMoeda = $moedaUsuario->quantidade_total_moeda;
        $valorTotalInvestido    = $moedaUsuario->valor_total_investido;
        $valorGasto             = $dadosVenda['quantidadeMoeda'] * $moedaUsuario->preco_medio;

        //subitração do valor total de moedas atual pela a quantidade da moeda que foi vendida
        $quantidadeTotalDeMoedaPosVenda = $quantidadeTotalDeMoeda - $dadosVenda['quantidadeMoeda'];
        //subitração do valor investido
        $valorTotalInvestidoPosVenda = $valorTotalInvestido - $valorGasto;
        
        $this->moedaUsuarioModel->__set('quantidadeTotalMoeda', $quantidadeTotalDeMoedaPosVenda);
        $this->moedaUsuarioModel->__set('valorTotalInvestido', $valorTotalInvestidoPosVenda);
        //atualiza a quantidade de moeda e o valor investido
        $this->moedaUsuarioModel->updateQuantidadeMoedaEValorInvestido();

        $precoMedioCompra = $moedaUsuario->preco_medio;
        $lucro = $this->lucro($precoMedioCompra, $dadosVenda['quantidadeMoeda'], $dadosVenda['precoVenda']);
        
        $this->vendaModel->__set('idUsuario', $idUsuario);
        $this->vendaModel->__set('idMoeda', $dadosVenda['idMoeda']);
        $this->vendaModel->__set('quantidadeMoeda', $dadosVenda['quantidadeMoeda']);
        $this->vendaModel->__set('precoMedio', $precoMedioCompra);
        $this->vendaModel->__set('precoVenda', $dadosVenda['precoVenda']);
        $this->vendaModel->__set('lucro', $lucro['lucro']);
        $this->vendaModel->__set('lucroPorcentagem', $lucro['lucroEmPorcentagem']);
        $this->vendaModel->__set('data', $dadosVenda['dataVenda']);
      
        $insert = $this->vendaModel->insert();

        if($insert){
            header('Location: ../../vendas.php');
        }else{
            echo "deu erro";
            
        }
    }

    public function lucro($precoMedioMoeda, $quantidadeMoeda, $precoVenda)
    {
        
        $valorGasto    = $quantidadeMoeda * $precoMedioMoeda;
        $valorDaVenda  = $quantidadeMoeda * $precoVenda;

        $lucro = $valorDaVenda - $valorGasto;

        $lucroPorcentagemBruta = ($valorDaVenda * 100) / $valorGasto;
        $lucroEmPorcentagem    = $lucroPorcentagemBruta - 100;

        $lucroArredondado = round($lucro, 4);
        $lucroEmPorcentagemArredondado = round($lucroEmPorcentagem, 2);

        return ['lucro' => $lucroArredondado, 'lucroEmPorcentagem' => $lucroEmPorcentagemArredondado];

    }


    public function vericaVendaMaiorQueQuantidadeComprada($quantidadeMoedaVendida, $quantidadeMoedaComprada)
    {
        
        if($quantidadeMoedaVendida > $quantidadeMoedaComprada){

            return true;

        }else{
            return false;
        }
    }

}