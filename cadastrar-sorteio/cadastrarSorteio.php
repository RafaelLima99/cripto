<?php

require_once "../app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";
require_once "../app/Services/Alerta.php";

$mensagemAlerta = false;

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
                        Cadastrar Sorteio
                    </strong>
                    <a href="index.php" class="float-end">
                        <img src="../assets/icones-svg/close.svg" style="height:1.3rem;">
                    </a>
                </div>
                <div class="card-body">
                    <form action="../app/Actions/cadastrarSorteioAction.php" method="POST">
                        <div class="mb-3">
                            <label for="nomeSorteio" class="col-form-label weight-600">
                                Nome Sorteio:
                            </label>
                            <input type="text" class="form-control" id="nomeSorteio" name="nomeSorteio" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="col-form-label weight-600">
                                Status:
                            </label>
                            <select class="form-select" aria-label="Default select example" id="status" name="status">
                                <option value="inativo">Inativo</option>
                                <option value="ativo">Ativo</option>
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