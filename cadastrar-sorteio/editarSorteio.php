<?php

require_once "../app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";
require_once "../app/Controllers/SorteioController.php";
require_once "../app/Services/Alerta.php";

$idSorteio         = null;
$mensagemAlerta    = null;
$sorteioController = new SorteioController();

if(isset( $_GET['idSorteio'])){
    $idSorteio = $_GET['idSorteio'];
}

if(Alerta::verificaAlertaErro()){
    $mensagemAlerta = Alerta::mensagemAlerta();
}

$sorteio = $sorteioController->editar($idSorteio);

?>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <?php if($mensagemAlerta != null) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $mensagemAlerta['msg'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
            <div class="card shadow mb-5 rounded mt-4">
                <div class="card-header">
                    <Strong>
                        Editar Sorteio
                    </Strong>
                    <a href="index.php" class="float-end">
                        <img src="../assets/icones-svg/close.svg" style="height:1.3rem;">
                    </a>
                </div>
                <div class="card-body">
                    <form action="../app/Actions/editarSorteioAction.php" method="POST">
                        <div class="mb-3">
                            <label for="nome-sorteio" class="col-form-label weight-600">
                                Nome Sorteio:
                            </label>
                            <input type="text" class="form-control" id="nome-sorteio" name="nome-sorteio" value="<?=$sorteio->nome_sorteio?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="col-form-label weight-600">Status:</label>
                            <select class="form-select" aria-label="Default select example" id="status" name="status">
                                
                                <?php if ($sorteio->ativo == 0) {?>
                                  <option value="inativo" selected>Inativo</option>
                                  <option value="ativo">Ativo</option>
                                
                                <?php } else { ?>
                                    <option value="inativo">Inativo</option>
                                    <option value="ativo" selected>Ativo</option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" name="idSorteio" value="<?= $idSorteio ?>">
                        <div>
                            <button type="submit" class="btn btn-secondary mt-2">Editar</button>
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