<?php
  require_once("libs/validadores.php");
  require_once("models/portafolios/documentos/documentos.model.php");
  require_once('models/portafolios/documentos/comentario.model.php');


  function run(){
    $viewData = array();
      $viewData["mode"] = "";
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
    //__________________________________________________________________________________________
      if(isset($_POST["btnComentar"])){
        $viewData["usuarioingresa"]=$_SESSION["userCode"];
        $viewData["comentario"]=$_POST["comentarioNuevo"];

        $fch = Date('Y-m-d h:i:s');
        $lastId = insertComent($viewData["documentoportafoliocodigo"],
                  $viewData["comentario"], $viewData["usuarioingresa"],
                  $fch, "ACT");

        if($lastId){
          redirectWithMessage("Comentario realizado.", "index.php?page=docuview");
          die();
        }else{
          redirectWithMessage("Error al crear comentario.", "index.php?page=docuview");
          $viewData["errores"][] = "Error al crear comentario";
        }
      } // end post btnComentar




    }

    $folioDocumento = obtenerFlujoNombre($viewData["documentoportafoliocodigo"], $viewData["portafoliocodigo"]);
    mergeFullArrayTo($folioDocumento,$viewData);
  //  print_r($viewData);
    renderizar("portafolios/documentos/docuview", $viewData);
  }
  run();
 ?>
