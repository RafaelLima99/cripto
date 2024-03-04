<?php

require_once "../Controllers/VendaController.php";

// echo "<pre>";
// var_dump($_POST);die;

if(!empty($_POST)){

    $idMoeda          = $_POST['idMoeda'];
    $precoMoedaVenda  = $_POST['precoMoedaVenda'];
    $quantidadeMoeda  = $_POST['quantidadeMoeda'];
    $dataVenda        = $_POST['dataVenda'];

    if(empty($idMoeda)){
        header('Location: ../../cadastrar_venda.php');
        die;
    }
    
    if(empty($precoMoedaVenda)){
        header('Location: ../../cadastrar_venda.php');
        die;
    }

    if(empty($quantidadeMoeda)){
        header('Location: ../../cadastrar_venda.php');
        die;
    }

    if(empty($dataVenda)){
        header('Location: ../../cadastrar_venda.php');
        die;
    }
    
    $dadosVenda = ['idMoeda' => $idMoeda, 'precoVenda' => $precoMoedaVenda, 'quantidadeMoeda' =>
                     $quantidadeMoeda, 'dataVenda' => $dataVenda];

    $vendaController = new VendaController();
    
    $vendaController->criar($dadosVenda);   

}

