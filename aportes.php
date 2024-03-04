<?php
require_once "app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";
require_once "app/Controllers/AporteController.php";

$aporteController = new AporteController();
$aportes = $aporteController->getAportes();

?>

<div class="container pt-5">

    
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Moeda</th>
                    <th scope="col">Preço da Moeda na Compra</th>
                    <th scope="col">Valor Investido</th>
                    <th scope="col">Data Aporte</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aportes as $key => $aporte) { ?>
                    <tr>
                        <td> 
                            <img src="<?= $aporte->link_logo ?>" height="25" width="25" class="me-2">
                            <?= $aporte->moeda ?>
                        </td>
                        <td>US$ <?= $aporte->preco_moeda_compra ?></td>
                        <td>US$ <?= $aporte->valor_aporte ?></td>
                        <td><?= date('d/m/Y',  strtotime($aporte->data_aporte))?></td>
                        
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