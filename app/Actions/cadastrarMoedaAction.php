<?php

require_once "../Controllers/MoedaController.php";

if(!empty($_POST)){
    $moeda    = $_POST['moeda'];
    $codMoeda = $_POST['codMoeda'];
    $linkLogo = $_POST['linkLogo'];

    if(empty($moeda)){
        header('Location: ../../cadastrar_moeda.php');
    }
    
    if(empty($codMoeda)){
        header('Location: ../../cadastrar_moeda.php');
    }
    
    if(empty($linkLogo)){
        header('Location: ../../cadastrar_moeda.php');
    }
    
    $dadosMoeda = ['moeda' => $moeda, 'codMoeda' => $codMoeda, 'linkLogo' => $linkLogo];

    
    $moedaController = new MoedaController();
    
    $moedaController->criar($dadosMoeda);   

}
