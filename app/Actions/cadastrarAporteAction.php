<?php

require_once "../Controllers/AporteController.php";

if(!empty($_POST)){

   
    $idMoeda            = $_POST['idMoeda'];
    $precoMoedaCompra   = $_POST['precoMoedaCompra'];
    $quantidadeDeMoedas = $_POST['quantidadeDeMoedas'];
    $valorAporte        = $_POST['valorAporte'];
    $dataCompra         = $_POST['dataCompra'];

    if(empty($idMoeda)){
        header('Location: ../../cadastrar_aporte.php');
        die;
    }
    
    if(empty($precoMoedaCompra)){
        
        header('Location: ../../cadastrar_aporte.php');
        die;
    }

    if(empty($quantidadeDeMoedas)){
        header('Location: ../../cadastrar_aporte.php');
        die;
    }

    if(empty($valorAporte)){
        header('Location: ../../cadastrar_aporte.php');
        die;
    }
    
    if(empty($dataCompra)){
        header('Location: ../../cadastrar_aporte.php');
        die;
    }
    
    $dadosAporte = ['idMoeda' => $idMoeda, 'precoMoedaCompra' => $precoMoedaCompra, 'quantidadeDeMoedas' =>
                     $quantidadeDeMoedas, 'valorAporte' => $valorAporte, 'dataCompra' => $dataCompra];

    $aporteController = new AporteController();
    
    $aporteController->criar($dadosAporte);   

}

?>