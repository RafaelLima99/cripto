<?php

require_once "../app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";
require_once "../app/Controllers/CodigoSorteioController.php";
require_once "../app/Services/Alerta.php";

if(isset($_GET['pg'])){
    $paginaAtual = $_GET['pg'];
}else{
    $paginaAtual = 1;
}

$mensagemAlerta          = null;
$codigoSorteioController = new CodigoSorteioController();
$codigoSorteios          = $codigoSorteioController->index($paginaAtual);
$quantidadeDePaginas     = $codigoSorteioController->quantidadeDePaginas();

if(Alerta::verificaAlertaSucesso()){
    $mensagemAlerta = Alerta::mensagemAlerta();
}
?>

<div class="container">
    <div class="mt-3">
        <?php if($mensagemAlerta != null) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $mensagemAlerta['msg'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>
        <a type="button" class="btn btn-secondary mb-3" href="cadastrarCodigoSorteio.php">Cadastrar Código</a>
        <table class="table table-hover shadow p-3 mb-3 bg-body-tertiary rounded">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Região</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fraqueado</th>
                    <th scope="col">Código da Promoção</th>
                    <th scope="col">Sorteio Vinculado</th>
                    <th scope="col">Inscritos </th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($codigoSorteios as $codigoSorteio) {?>
                <tr>
                    <th scope="row">
                        <?=$codigoSorteio->id_codigo?>
                    </th>
                    <td>
                        <?=$codigoSorteio->regiao?>
                    </td>
                    <td>
                        <?=$codigoSorteio->estado?>
                    </td>
                    <td>
                        <?=$codigoSorteio->franqueado?>
                    </td>
                    <td>
                        <?=$codigoSorteio->codigo_premio?>
                    </td>
                    <td>
                        <?=$codigoSorteio->nome_sorteio?>
                    </td>
                    <td>
                        <?=$codigoSorteio->quantidade_participantes_por_codigo_campanha?>
                    </td>
                    <td>
                        <a type="button" class="btn btn-secondary  btn-sm" href="editarCodigoSorteio.php?idCodigoSorteio=<?=$codigoSorteio->id_codigo?>">Editar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example border border-dark">
            <ul class="pagination">
                <?php if($paginaAtual > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="codigoSorteio.php?pg=1">Primeira</a>
                </li>
                <?php } ?>

                <!-- inicio do botão Anterior -->
                <?php if($paginaAtual == 1) { ?>
                    <li class="page-item disabled"> 
                        <a class="page-link">&laquo;</a>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <a class="page-link" href="codigoSorteio.php?pg=<?= $paginaAtual - 1?>">&laquo;</a>
                    </li>
                <?php } ?>
                <!-- fim do botão Anterior -->

                <?php if($paginaAtual > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="codigoSorteio.php?pg=<?= $paginaAtual - 1?>"><?= $paginaAtual - 1?></a>
                </li>
                <?php } ?>

                <li class="page-item">
                    <a class="page-link active" href="codigoSorteio.php?pg=<?= $paginaAtual?>"><?= $paginaAtual ?></a>
                </li>

                <?php if($paginaAtual < $quantidadeDePaginas) {?>
                <li class="page-item">
                    <a class="page-link" href="codigoSorteio.php?pg=<?= $paginaAtual + 1?>"><?= $paginaAtual + 1?></a>
                </li>
                <?php } ?>
                
                
                <!-- inicio do botão Proximo -->
                <?php if($paginaAtual == $quantidadeDePaginas) { ?>
                <li class="page-item">
                    <a class="page-link disabled" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php } else { ?>
                    <li class="page-item">
                    <a class="page-link" href="codigoSorteio.php?pg=<?= $paginaAtual + 1?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php } ?>
                <!-- fim botão proximo -->

                <?php if($quantidadeDePaginas > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="codigoSorteio.php?pg=<?= $quantidadeDePaginas?>">Última</a>
                </li>
                <?php } ?>
                
            </ul>
        </nav>
    </div>
</div>

<?php
require_once "template/footer.php";
?>