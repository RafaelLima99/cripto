<?php


 //alterar id do user
 $this->moedaUsuarioModel->__set('idUsuario', 2);
        
 $idMoedasUsuario = $this->moedaUsuarioModel->findByIdUser();

 foreach ($idMoedasUsuario as $valor) {
     //alterar id do user
     $this->aporteModel->__set('idUsuario', 2);
     $this->aporteModel->__set('idMoeda', $valor->id_moeda);
     echo '<pre>';

     var_dump($this->aporteModel->findByIdUsuarioAndIdMoeda());

   // var_dump($this->aporteModel);
     
 }