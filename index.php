<?php
require_once "app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";
require_once "app/Controllers/IndexController.php";

$indexController = new IndexController();

$dadosPortfolio = $indexController->getDadosPortfolio();

$moedas = $dadosPortfolio['usuarioMoedas'];
$dadosTotaisPortfolio = $dadosPortfolio['dadosTotaisPortfolio'];

?>

<div class="container pt-5">
    <?php if ($moedas != null) { ?>
    <div class="row">
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
            
                <div class="card-body" >
                    <div class="pb-2">
                        Total Investido
                    </div>
                    
                    <div style="font-size: 20px; font-weight:600">
                        U$ <?= $dadosTotaisPortfolio['totalInvestidoPortfolio']?>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
            
                <div class="card-body" >
                    <div class="pb-2">
                        Total com Lucro
                    </div>
                    
                        
                    <div style="font-size: 20px; font-weight:600">
                        U$ <?=$dadosTotaisPortfolio['totalInvestidoComLucroPortfolio']?>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
            
                <div class="card-body" >
                    <div class="pb-2">
                        Lucro
                    </div>
                    <?php if ($dadosTotaisPortfolio['totalInvestidoComLucroPortfolio'] < 0) { ?>
                        <div class="text-danger" style="font-size: 20px; font-weight:600">
                            U$ <?=$dadosTotaisPortfolio['totalLucroPortfolio']?>
                        </div>
                    <?php } else { ?>
                        <div class="text-success" style="font-size: 20px; font-weight:600">
                            U$ <?=$dadosTotaisPortfolio['totalLucroPortfolio']?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
            
                <div class="card-body" >
                    <div class="pb-2">
                        Lucro %
                    </div>
                    
                    <?php if ($dadosTotaisPortfolio['totalPorcentagemLucroPortfolio'] < 0) { ?>
                        <div class="text-danger" style="font-size: 20px; font-weight:600">
                            <?=$dadosTotaisPortfolio['totalPorcentagemLucroPortfolio']?> %
                        </div>
                    <?php } else { ?>
                        <div class="text-success" style="font-size: 20px; font-weight:600">
                            <?=$dadosTotaisPortfolio['totalPorcentagemLucroPortfolio']?> %
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Moeda</th>
                    <th scope="col">Preço Atual</th>
                    <th scope="col">Preço Médio</th>
                    <th scope="col">Valor Investido</th>
                    <th scope="col">Lucro</th>
                    <th scope="col">Lucro %</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($moedas as $key => $moeda) {?>
                    <tr>
                        <td> 
                            <img src="<?= $moeda->link_logo ?>" height="25" width="25" class="me-2">
                            <?= $moeda->moeda ?>
                        </td>
                        <td>US$ <?= $moeda->preco_atual ?></td>
                        <td>US$ <?= $moeda->preco_medio ?></td>
                        <td>US$ <?= $moeda->valor_total_investido?></td>

                        <?php if($moeda->lucro < 0) { ?>
                            <td class="text-danger">US$ <?= $moeda->lucro ?></td>
                            <td class="text-danger"><?= $moeda->lucro_em_porcentagem ?> %</td>
                        <?php } else { ?>
                            <td class="text-success">US$ <?= $moeda->lucro ?></td>
                            <td class="text-success"><?= $moeda->lucro_em_porcentagem ?> %</td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Você ainda não fez nenhum aporte
        </div>
    <?php } ?>
</div>

<?php
 require_once "template/footer.php"
?>