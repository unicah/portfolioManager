<?php
  require_once("libs/validadores.php");
  require_once("models/portafolios/documentos/documentos.model.php");
  //----------------Testing purposes----------------------------------------------------/
  require_once('models/portafolios/portafolios.model.php');
 //--------------------------------------------------------------------/
  require_once('models/portafolios/documentos/comentario.model.php');
  function run(){
    $viewData = array();
    $viewData["mode"] = "";
    $viewData["documentoportafoliocodigo"]="";
    $viewData["portafoliocodigo"]=0;

    $viewData["documentoportafolio"] = 0;
    $viewData["colaboradores"] = array();
    $viewData["versiones"]=array();


    if(isset($_SESSION["portafoliocodigo"])){
      $viewData["portafoliocodigo"] = $_SESSION["portafoliocodigo"];
    }

    if(isset($_SESSION["documentoportafolio"])){
      $viewData["documentoportafolio"] = $_SESSION["documentoportafolio"];
    }

    //recoje el docod que tiene el documentoportafoliocodigo xD
    if(isset($_POST["btnComentar"])){
        $lastId = insertComent($viewData["documentoportafolio"],
                  $_POST["comentarioNuevo"], $_SESSION["userCode"]);

    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(isset($_POST["docod"])){
        $_SESSION["documentoportafolio"] = $_POST["docod"];
        redirectToUrl("index.php?page=docuview");
      }
    }

    $folioDocumento = obtenerFlujoNombre($viewData["documentoportafolio"], $viewData["portafoliocodigo"]);
    mergeFullArrayTo($folioDocumento,$viewData);
  //  print_r($viewData);

//TODO: Este bloque de control es el que queda al final cuando ya se corrija lo de la llave
//     if($viewData["documentoportafolio"] > 0){
//          $tmp = obtenerversionPorCodigo($viewData["documentoportafolio"]);
//           mergeFullArrayTo($tmp, $viewData);
//           $viewData["versiones"]=obtenerVersionesPortafolio($viewData["documentoportafolio"],'');
//           $viewData["colaboradores"] = obtenerColaboradoresDelDocumento($_SESSION["documentoportafolio"]);
//     }
//TODO: Eliminar esto cuando quede los del la llave corregido
    if($viewData["documentoportafolio"] > 0){
      $viewData["versiones"]=obtenerVersionesPortafolio($viewData["documentoportafolio"]);
      $viewData["colaboradores"] = obtenerColaboradoresDelDocumento($viewData["documentoportafolio"]);
      $viewData["comentarios"] = obtenerComentarios($viewData["documentoportafolio"]);
    }


    renderizar("portafolios/documentos/docuview", $viewData);
  }
  run();
 ?>
