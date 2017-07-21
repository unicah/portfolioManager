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
    //TODO: Refizar las referencias a documentoportafoliocodigo este es solo visual no llave
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

//TODO: Este bloque de control es el que queda al final cuando ya se corrija lo de la llave
//     if($viewData["documentoportafolio"] > 0){
//          $tmp = obtenerversionPorCodigo($viewData["documentoportafolio"]);
//           mergeFullArrayTo($tmp, $viewData);
//           $viewData["versiones"]=obtenerVersionesPortafolio($viewData["documentoportafolio"],'');
//           $viewData["colaboradores"] = obtenerColaboradoresDelDocumento($_SESSION["documentoportafolio"]);
//     }
//TODO: Eliminar esto cuando quede los del la llave corregido
  if($viewData["documentoportafoliocodigo"] > 0){
    $tmp = obtenerversionPorCodigo($viewData["documentoportafoliocodigo"]);
    mergeFullArrayTo($tmp, $viewData);
    $viewData["versiones"]=obtenerVersionesPortafolio($viewData["documentoportafoliocodigo"],'');

  }


    renderizar("portafolios/documentos/docuview", $viewData);
  }
  run();
 ?>
