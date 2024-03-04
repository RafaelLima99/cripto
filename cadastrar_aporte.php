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
                <h5 class="card-header">Cadastrar Aporte</h5>
                    <div class="card-body">

                       <form action="app/Actions/cadastrarAporteAction.php" method="post">

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
                                <label class="form-label">Preço Moeda Na Compra:</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="precoMoedaCompra" placeholder="Ex: 1.05" step="0.01" min="0" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantidade de Moedas:</label>
                                <input type="number" class="form-control" name="quantidadeDeMoedas" placeholder="Ex: 0.0890" step="0.0001" min="0" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Valor Aporte (USDT):</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="valorAporte" placeholder="Ex: 40.07" step="0.01" min="0" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Data da compra:</label>
                                <input type="date" class="form-control" name="dataCompra" required>
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