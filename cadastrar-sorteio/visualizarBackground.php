<?php

require_once "../app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";

$imgBackground = null;

if(!empty($_GET['imgBackground'])){
    $imgBackground = $_GET['imgBackground'];
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card shadow mb-5 rounded mt-4">
                <div class="card-header">
                    <strong>
                        Background
                    </strong>
                    <a href="index.php" class="float-end">
                        <img src="../assets/icones-svg/close.svg" style="height:1.3rem;">
                    </a>
                </div>
                <div class="card-body">
                   <img src="../assets/imagens-background/<?= $imgBackground ?>" style="max-height: 70vh; max-width: 100%">
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php
require_once "template/footer.php";
?>