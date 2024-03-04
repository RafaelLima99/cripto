<?php
 require_once "app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";
require_once "app/Controllers/MoedaController.php";

$erro = false;

if(isset($_GET['erro'])){
    $erro = $_GET['erro'];
    if($erro == 'venda-maior-que-quantidade-comprada'){
        $erro = 'Quantidade de moedas maior que a quantidade disponível para venda';
    }
}



$moedaController = new MoedaController();
$moedas = $moedaController->getMoedas();


?>
<div class="container pt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <?php if ($erro) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $erro ?>
                </div>
            <?php } ?>
            <div class="card">
                <h5 class="card-header">Cadastrar Venda</h5>
                    <div class="card-body">

                       <form action="app/Actions/cadastrarVendaAction.php" method="post">

                            <div class=" mb-3">  
                                <label for="exampleFormControlInput1" class="form-label">Selecione a Moeda:</label>
                                <select class="form-select" aria-label="Default select example" name="idMoeda" required>
                                    <option value="">-- Selecione a moeda --</option>
                                  <?php foreach ($moedas as $key => $moeda) {?>

                                    <option value="<?=$moeda->id?>"><?=$moeda->moeda?></option>
    
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Preço Moeda Na Venda:</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="precoMoedaVenda" placeholder="Ex: 1.05" step="0.01" min="0" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantidade de Moedas:</label>
                                <input type="number" class="form-control" name="quantidadeMoeda" placeholder="Ex: 0.0890" step="0.0001" min="0" required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Data da Venda:</label>
                                <input type="date" class="form-control" name="dataVenda" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Cadastrar</button>
                            </div> 
                       </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>




</div>
<?php
 require_once "template/footer.php"
?>