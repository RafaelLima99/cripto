<?php
 require_once "template/header.php"
?>
<div class="container pt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Criar Conta</h5>
                <div class="card-body">

                    <form action="app/Actions/criarContaAction.php" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha">
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Cadastrar</button>
                        </div> 
                    </form>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/poper.js"></script>
    </body>
</html>
    
