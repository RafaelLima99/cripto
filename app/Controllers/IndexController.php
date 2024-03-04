<?php

require_once dirname(__DIR__)."/Models/Usuario.php";
require_once dirname(__DIR__)."/Models/Moeda.php";
require_once dirname(__DIR__)."/Models/MoedaUsuario.php";
require_once dirname(__DIR__)."/Models/Aporte.php";


class IndexController
{
    private $usuarioModel;
    private $moedaModel;
    private $moedaUsuarioModel;
    private $aporteModel;
    public function __construct()
    {
        $this->usuarioModel        = new Usuario();
        $this->moedaModel          = new Moeda();
        $this->moedaUsuarioModel   = new MoedaUsuario();
        $this->aporteModel         = new Aporte();
      
    }

    public function getDadosPortfolio()
    {

        
        $idUsuario = $_SESSION['idUsuario'];
   
        $this->moedaUsuarioModel->__set('idUsuario', $idUsuario);
        
        $usuarioMoedas = $this->moedaUsuarioModel->findByIdUser();


        if(isset($usuarioMoedas)){
            return ['usuarioMoedas' => null, 'dadosTotaisPortfolio' => null];
            die;
        }


        foreach ($usuarioMoedas as $chave => $usuarioMoeda) {

            $precoAtualDaMoeda = $this->precoAtual($usuarioMoeda->cod_moeda_binance);

            $arrayLucro = $this->lucro($usuarioMoeda->preco_medio, $usuarioMoeda->quantidade_total_moeda, $precoAtualDaMoeda);
            $usuarioMoedas[$chave]->lucro                = $arrayLucro['lucro'];
            $usuarioMoedas[$chave]->lucro_em_porcentagem = $arrayLucro['lucroEmPorcentagem'];
            $usuarioMoedas[$chave]->preco_atual          = $precoAtualDaMoeda;

           
        }
        // echo "<pre>";
        // var_dump($usuarioMoedas);die;
      
        $dadosTotaisPortfolio = $this->dadosTotaisPortfolio($usuarioMoedas);
        

        return [
                'usuarioMoedas' => $usuarioMoedas,
                'dadosTotaisPortfolio' => $dadosTotaisPortfolio
                ];
        
    }


    public function dadosTotaisPortfolio($usuarioMoedas)
    {

        $totalInvestidoPortfolio = 0;
        $totalLucroPortfolio = 0;
        

        foreach ($usuarioMoedas as $key => $usuarioMoeda) {
            $totalInvestidoPortfolio += $usuarioMoeda->valor_total_investido; 
            $totalLucroPortfolio += $usuarioMoeda->lucro;
        }
       
        $totalInvestidoComLucroPortfolio = $totalInvestidoPortfolio + $totalLucroPortfolio;

        $lucroPorcentagemBruta = ($totalInvestidoComLucroPortfolio * 100) / $totalInvestidoPortfolio;
        $totalPorcentagemLucroPortfolio = $lucroPorcentagemBruta - 100;
        $totalPorcentagemLucroPortfolioArredondado =  round($totalPorcentagemLucroPortfolio, 2);

        return [
                'totalInvestidoPortfolio' => $totalInvestidoPortfolio,
                'totalInvestidoComLucroPortfolio' => $totalInvestidoComLucroPortfolio,
                'totalLucroPortfolio' => $totalLucroPortfolio,
                'totalPorcentagemLucroPortfolio' => $totalPorcentagemLucroPortfolioArredondado,
               
               ];

    }


    
    public function precoMedio($quantidadeTotalDaMoeda, $valorTotalGasto)
    {
        $precoMedio = $valorTotalGasto / $quantidadeTotalDaMoeda;
        
        $precoMedioArredondado = round($precoMedio, 4);

        return $precoMedioArredondado;
    }


    public function lucro($precoMedioDaMoeda, $quantidadeTotalDaMoeda, $precoAtualDaMoeda)
    {
        
        $valorTotalInvestidoDaMoeda = $quantidadeTotalDaMoeda * $precoMedioDaMoeda;
        $valorTotalAtualDaMoeda = $quantidadeTotalDaMoeda * $precoAtualDaMoeda;

        $lucro = $valorTotalAtualDaMoeda - $valorTotalInvestidoDaMoeda;

        $lucroPorcentagemBruta = ($valorTotalAtualDaMoeda * 100) / $valorTotalInvestidoDaMoeda;
        $lucroEmPorcentagem = $lucroPorcentagemBruta - 100;

        $lucroArredondado = round($lucro, 4);
        $lucroEmPorcentagemArredondado = round($lucroEmPorcentagem, 2);

        return ['lucro' => $lucroArredondado, 'lucroEmPorcentagem' => $lucroEmPorcentagemArredondado];

    }

    public function precoAtual($codMoeda)
    {
        $apiBinance = 'https://api.binance.com/api/v3/avgPrice?symbol='.$codMoeda;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiBinance);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $head = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $precoAtual = json_decode($head)->price;

        $precoAtualArredondado = round($precoAtual, 4);

        return $precoAtualArredondado;
    }
}