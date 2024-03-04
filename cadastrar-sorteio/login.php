<?php

require_once "../app/Services/Alerta.php";

$mensagemAlerta = null;

session_start();
if(Alerta::verificaAlertaErro()){
    $mensagemAlerta = Alerta::mensagemAlerta();
}


?>

<!doctype html>
<html lang="pt" data-bs-theme="light">
   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/style.css" rel="stylesheet">
    </head>
    <body class="bg-gray">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center" style="height:100vh">
                <div class="col-md-3 align-self-center">
                    <?php if($mensagemAlerta != null) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $mensagemAlerta['msg'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <div class="card shadow rounded">
                        <div class="card-body">
                            <div style="text-align: center;">
                                <img src="../assets/img/logo_premia2.png" alt="" srcset="" width="200px">
                            </div>
                            <form action="../app/Actions/loginAction.php" method="post">
                                <div class="mb-3 mt-2">
                                    <label for="usuario" class="form-label weight-600">Usuário:</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                                </div>
                                <div class="mb-3 mt-4">
                                    <label for="senha" class="form-label weight-600">Senha:</label>
                                    <input type="password" class="form-control" id="senha" name="senha" required>
                                </div>
                                <div class="d-grid gap-2 mt-4 mb-4">
                                    <button class="btn btn-secondary" type="submit">Acessar</button>
                                </div>
                            </form>	
                        </div>
                    </div>
                </div>
            </div>
       
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/poper.js"></script>
    </body>
</html>