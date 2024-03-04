<?php

require_once "../app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";
require_once "../app/Controllers/CodigoSorteioController.php";
require_once "../app/Services/Alerta.php";

$mensagemAlerta = false;
$codigoSorteioController = new CodigoSorteioController();
$estados  = $codigoSorteioController->estado();
$sorteios = $codigoSorteioController->sorteios();

if(Alerta::verificaAlertaErro()){
    $mensagemAlerta = Alerta::mensagemAlerta();
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <?php if($mensagemAlerta != false) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $mensagemAlerta['msg'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
            <div class="card shadow mb-5 rounded mt-4">
                <div class="card-header">
                    <strong>
                        Cadastrar Código Sorteio
                    </strong>
                    <a href="codigoSorteio.php" class="float-end">
                        <img src="../assets/icones-svg/close.svg" style="height:1.3rem;">
                    </a>
                </div>
                <div class="card-body">
                    <form action="../app/Actions/cadastrarCodigoSorteioAction.php" method="POST">
                        <div class="mb-3">
                            <label for="regiao" class="col-form-label weight-600">Região:</label>
                            <input type="text" class="form-control" id="regiao" name="regiao" required>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="col-form-label weight-600">Estado:</label>
                            <select class="form-select" aria-label="Default select example" id="estado" name="estado">
                            <?php foreach($estados as $estado) { ?>
                                    <option value="<?= $estado->sigla ?>" ><?= $estado->sigla ?> - <?= $estado->nome ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="franqueado" class="form-label weight-600">Franqueado:</label>
                            <input type="text" class="form-control" id="franqueado" name="franqueado" required>
                        </div>

                        <div class="mb-3">
                            <label for="codigo-promocao" class="form-label weight-600">Código da Promoção:</label>
                            <input type="text" class="form-control" id="codigo-promocao" name="codigo-promocao" required>
                        </div>

                        <div class="mb-3">
                            <label for="sorteio-vincular" class="col-form-label weight-600">Sorteio para vincular:</label>
                            <select class="form-select" aria-label="Default select example" id="sorteio-vincular" name="sorteio-vincular">
                            <?php foreach($sorteios as $sorteio) {?>
                                <option value="<?= $sorteio->id_sorteio?>"><?= $sorteio->nome_sorteio ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-secondary mt-2">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<?php
require_once "template/footer.php";
?>