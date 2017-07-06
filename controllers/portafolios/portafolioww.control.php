<?php
/* Work With Portafolio  Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */
  require_once('models/portafolios/portafolios.model.php');
  require_once('models/portafolios/documentos/documentos.model.php');
  function run(){
    $viewData = array();
    $viewData["portafoliocodigo"] = 0;
    $viewData["colaboradores"] = array();

    if(isset($_SESSION["portafoliocodigo"])){
        $viewData["portafoliocodigo"] = $_SESSION["portafoliocodigo"];
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
      if(isset($_POST["prtfcod"])){
        $_SESSION["portafoliocodigo"] = intval($_POST["prtfcod"]);
        $viewData["portafoliocodigo"] = $_SESSION["portafoliocodigo"];
        redirectToUrl("index.php?page=portafolioww");
      }
    }

    if($viewData["portafoliocodigo"] > 0){
      $tmp = obtenerPortafolioPorCodigo($viewData["portafoliocodigo"]);
      mergeFullArrayTo($tmp, $viewData);
      // Obtenemos los colaboradores
      $viewData["colaboradores"] = obtenerColaboradoresDelPortafolio($viewData["portafoliocodigo"]);
      $viewData["documentos"] = obtenerDocumentosDelPortafolio($viewData["portafoliocodigo"],'');

    }

    renderizar("portafolios/portfolioww",$viewData);
  }


  run();
?>
