<?php

require_once "../Controllers/LoginController.php";

if(!empty($_POST)){

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if(empty($email)){
        header('Location: ../../login.php');
    }
    
    if(empty($senha)){
        header('Location: ../../login.php');
    }
    
    $dadosConta = ['email' => $email, 'senha' => $senha];

    
    $loginController = new LoginController();
    $loginController->logar($dadosConta);   

}
