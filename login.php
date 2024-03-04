<?php
 require_once "template/header.php"
?>

<div class="container pt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Login</h5>
                <div class="card-body">

                    <form action="app/Actions/loginAction.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control"name="senha">
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Entrar</button>
                        </div> 
                    </form>

                <a href="criar_conta.php">criar conta</a>
            </div>
        </div>
    </div>
</div>

<?php
 require_once "template/footer.php"
?>