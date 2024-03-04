<?php

require_once "../Controllers/ContaController.php";

if(!empty($_POST)){
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if(empty($nome)){
        header('Location: ../../criar_conta.php');
    }
    
    if(empty($email)){
        header('Location: ../../criar_conta.php');
    }
    
    if(empty($senha)){
        header('Location: ../../criar_conta.php');
    }
    
    $dadosConta = ['nome' => $nome, 'email' => $email, 'senha' => $senha];

    
    
    $contaController = new ContaController();
    
    $contaController->criar($dadosConta);   

}
