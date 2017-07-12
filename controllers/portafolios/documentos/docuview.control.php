<?php
  require_once("libs/validadores.php");
  require_once("models/portafolios/documentos/documentos.model.php");


  function run(){
    $viewData = array();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
      $viewData["documentodescripcion"] = $_GET["docod"];
    }

    renderizar("portafolios/documentos/docuview", $viewData);
  }
  run();
 ?>
