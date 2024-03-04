<?php
require_once "app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";
require_once "app/Controllers/VendaController.php";

$vendaController = new VendaController();
$getVendas = $vendaController->getVendas();

$vendas = $getVendas['vendas'];
$lucroTotal = $getVendas['lucroTotal'];


?>

<div class="container pt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
            
                <div class="card-body" >
                    <div class="pb-2">
                        Lucro Total
                    </div>
                    <div style="font-size: 20px; font-weight:600">
                        U$ <?= $lucroTotal ?>
                    </div>
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
                    <th scope="col">Preço Médio</th>
                    <th scope="col">Preço Venda</th>
                    <th scope="col">Quantide de Moedas</th>
                    <th scope="col">Lucro</th>
                    <th scope="col">Lucro %</th>
                    <th scope="col">Data Venda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendas as $key => $venda) { ?>
                    <tr>
                        <td> 
                            <img src="<?= $venda->link_logo ?>" height="25" width="25" class="me-2">
                            <?= $venda->moeda ?>
                        </td>
                        <td>US$ <?= $venda->preco_medio ?></td>
                        <td>US$ <?= $venda->preco_venda ?></td>
                        <td>US$ <?= $venda->quantidade_moeda ?></td>
                        

                        <?php if($venda->lucro < 0) { ?>
                            <td class="text-danger">US$ <?= $venda->lucro ?></td>
                            <td class="text-danger"><?= $venda->lucro_porcentagem ?> %</td>
                        <?php } else { ?>
                            <td class="text-success">US$ <?= $venda->lucro ?></td>
                            <td class="text-success"><?= $venda->lucro_porcentagem ?> %</td>
                        <?php } ?>

                        <td><?=  date('d/m/Y',  strtotime($venda->data)) ?></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<?php
 require_once "template/footer.php"
?>