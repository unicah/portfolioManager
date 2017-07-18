<?php
  require_once("libs/validadores.php");
  require_once("models/portafolios/documentos/documentos.model.php");


  function run(){
    $viewData = array();
    $viewData["documentoportafoliocodigo"]="";
    $viewData["portafoliocodigo"]=0;
    if(isset($_SESSION["portafoliocodigo"])){
      $viewData["portafoliocodigo"] = $_SESSION["portafoliocodigo"];
    }
    if(isset($_SESSION["documentoportafoliocodigo"])){
      $viewData["documentoportafoliocodigo"] = $_SESSION["documentoportafoliocodigo"];
    }
    //recoje el docod que tiene el documentoportafoliocodigo xD
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(isset($_POST["docod"])){
        $_SESSION["documentoportafoliocodigo"] = $_POST["docod"];
        $viewData["documentoportafoliocodigo"] = $_SESSION["documentoportafoliocodigo"];
        redirectToUrl("index.php?page=docuview");//esto para que es?
      }
    }

    $folioDocumento = obtenerFlujoNombre($viewData["documentoportafoliocodigo"], $viewData["portafoliocodigo"]);
    mergeFullArrayTo($folioDocumento,$viewData);
  //  print_r($viewData);
    renderizar("portafolios/documentos/docuview", $viewData);
  }
  run();
 ?>
