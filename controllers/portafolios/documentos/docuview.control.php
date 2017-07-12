<?php
  require_once("libs/validadores.php");


  function run(){
    $viewData = array();
    renderizar("portafolios/documentos/docuview", $viewData);
  }
  run();
 ?>
