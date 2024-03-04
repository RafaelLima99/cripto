<?php

require_once "../app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}
require_once "template/header.php";
require_once '../app/Controllers/SorteioController.php';
require_once "../app/Services/Alerta.php";

if(isset($_GET['pg'])){
    $paginaAtual = $_GET['pg'];
}else{
    $paginaAtual = 1;
}

$mensagemAlerta      = null;
$sorteioController   = new SorteioController();
$sorteios            = $sorteioController->index($paginaAtual);
$quantidadeDePaginas = $sorteioController->quantidadeDePaginas();

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
        <a type="button" class="btn btn-secondary mb-3" href="cadastrarSorteio.php">Cadastrar Sorteio</a>
        <table class="table table-hover shadow p-3 mb-3 bg-body-tertiary rounded ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome do Sorteio</th>
                    <th scope="col">Status</th>
                    <th scope="col">Regulamento</th>
                    <th scope="col">Background</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($sorteios as $sorteio) { ?>
                <tr>
                    <th scope="row">
                        <?=$sorteio->id_sorteio?>
                    </th>
                    <td>
                        <?=$sorteio->nome_sorteio?>
                    </td>
                    <td>
                    <?php if($sorteio->ativo == 0){?>
                        <div class="badge bg-danger text-wrap" style="width: 4rem;">
                            Inativo
                        </div>
                    <?php } else {?>
                        <div class="badge bg-success text-wrap" style="width: 4rem;">
                            Ativo
                        </div>
                    <?php } ?>
                    </td>
                    <td>
                        <?php  if($sorteio->arquivo_regulamento == null) {?>
                           Sem Regulamento
                        <?php } else { ?>
                            <a href="../assets/regulamentos/<?=$sorteio->arquivo_regulamento?>" target="blank"> Ver Regulamento</a>
                        <?php } ?>
                    </td>
                    <td>
                        <?php  if($sorteio->img_background == null) {?>
                           Sem Background
                        <?php } else { ?>
                            <a href="visualizarBackground.php?imgBackground=<?= $sorteio->img_background ?>" type="button" class="btn btn-secondary btn-sm"> <strong>Visualizar</strong></a>
                        <?php } ?>
                    </td>
                    <td>
                        <a type="button" class="btn btn-secondary btn-sm" href="editarSorteio.php?idSorteio=<?=$sorteio->id_sorteio?>" data-bs-toggle="tooltip" data-bs-title="Editar Sorteio">
                            <img src="../assets/icones-svg/edit.svg">
                        </a>
                        <a type="button" class="btn btn-secondary btn-sm" href="adicionarBackground.php?idSorteio=<?=$sorteio->id_sorteio?>" data-bs-toggle="tooltip" data-bs-title="Adiconar Background">
                        
                            <img src="../assets/icones-svg/file-img-upload.svg">
                        </a>
                        <a type="button" class="btn btn-secondary btn-sm" href="adicionarRegulamento.php?idSorteio=<?=$sorteio->id_sorteio?>"  data-bs-toggle="tooltip" data-bs-title="Adicionar Regulamento">
                            <img src="../assets/icones-svg/file-upload.svg">
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example border border-dark">
            <ul class="pagination">
                <?php if($paginaAtual > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?pg=1">Primeira</a>
                </li>
                <?php } ?>

                <!-- inicio do botão Anterior -->
                <?php if($paginaAtual == 1) { ?>
                    <li class="page-item disabled"> 
                        <a class="page-link">&laquo;</a>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?pg=<?= $paginaAtual - 1?>">&laquo;</a>
                    </li>
                <?php } ?>
                <!-- fim do botão Anterior -->

                <?php if($paginaAtual > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?pg=<?= $paginaAtual - 1?>"><?= $paginaAtual - 1?></a>
                </li>
                <?php } ?>

                <li class="page-item">
                    <a class="page-link active" href="index.php?pg=<?= $paginaAtual?>"><?= $paginaAtual ?></a>
                </li>

                <?php if($paginaAtual < $quantidadeDePaginas) {?>
                <li class="page-item">
                    <a class="page-link" href="index.php?pg=<?= $paginaAtual + 1?>"><?= $paginaAtual + 1?></a>
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
                    <a class="page-link" href="index.php?pg=<?= $paginaAtual + 1?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php } ?>
                <!-- fim botão proximo -->

                <?php if($quantidadeDePaginas > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?pg=<?= $quantidadeDePaginas?>">Última</a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>

<?php
require_once "template/footer.php";
?>
