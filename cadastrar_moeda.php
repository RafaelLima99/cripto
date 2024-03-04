<?php
 
 require_once "app/Services/Login.php";

if(Login::verificaUsuarioEstaLogado() == false){
    header('Location: login.php');
}

require_once "template/header.php";

?>
<div class="container pt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <h5 class="card-header">Cadastrar Moeda</h5>
                    <div class="card-body">
                        
                        <form action="app/Actions/cadastrarMoedaAction.php" method="post">
                            <div class="mb-3">
                                <label for="moeda" class="form-label">Nome da Moeda</label>
                                <input type="text" class="form-control" id="moeda" name="moeda">
                            </div>
                            <div class="mb-3">
                                <label for="codMoeda" class="form-label">Codigo da Moeda (BINANCE)</label>
                                <input type="text" class="form-control" id="codMoeda" name="codMoeda">
                            </div>
                            
                            <div class="mb-3">
                                <label for="linkLogo" class="form-label">Link da Logo</label>
                                <input type="text" class="form-control" id="linkLogo" name="linkLogo">
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