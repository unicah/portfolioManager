<?php
  require_once("libs/validadores.php");
  require_once("models/portafolios/documentos/documentos.model.php");
  //----------------Testing purposes----------------------------------------------------/
  require_once('models/portafolios/portafolios.model.php');
 //--------------------------------------------------------------------/
  function run(){
    $viewData = array();
    $viewData["documentoportafoliocodigo"]="";
    $viewData["portafoliocodigo"]=0;
    $viewData["documentoportafolio"] = 0;
    $viewData["colaboradores"] = array();

    if(isset($_SESSION["portafoliocodigo"])){
      $viewData["portafoliocodigo"] = $_SESSION["portafoliocodigo"];
    }
    if(isset($_SESSION["documentoportafoliocodigo"])){
      $viewData["documentoportafoliocodigo"] = $_SESSION["documentoportafoliocodigo"];
    }

    if(isset($_SESSION["documentoportafolio"])){
      $viewData["documentoportafolio"] = $_SESSION["documentoportafolio"];
    }

    //recoje el docod que tiene el documentoportafoliocodigo xD
  /*  if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(isset($_POST["docod"])){
        $_SESSION["documentoportafoliocodigo"] = $_POST["docod"];
        $viewData["documentoportafoliocodigo"] = $_SESSION["documentoportafoliocodigo"];
        redirectToUrl("index.php?page=docuview");//esto para que es?
      }
    }
    */
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(isset($_POST["docod"])){
        $_SESSION["documentoportafolio"] = $_POST["docod"];
        $viewData["documentoportafolio"] = $_SESSION["documentoportafolio"];
        redirectToUrl("index.php?page=docuview");//esto para que es?
      }
    }

    $folioDocumento = obtenerFlujoNombre($viewData["documentoportafoliocodigo"], $viewData["portafoliocodigo"]);
    mergeFullArrayTo($folioDocumento,$viewData);
  //  print_r($viewData);

    if($viewData["portafoliocodigo"] > 0){
      $viewData["colaboradores"] = obtenerColaboradoresDelDocumento($_SESSION["documentoportafolio"]);
    }

    renderizar("portafolios/documentos/docuview", $viewData);
  }
  run();
 ?>
