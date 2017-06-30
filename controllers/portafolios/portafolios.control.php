<?php

  /* Users Controller
   * 2017-06-14
   * Created By OJBA
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
   require_once('models/portafolios/portafolios.model.php');
  function run(){
      $data = array();
      $data["fltNombre"] = "";
      $filter = '';
      if(isset($_SESSION["portafolios_context"])){
        $filter = $_SESSION["portafolios_context"]["filter"];
      }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $filter = $_POST["fltNombre"];
        $_SESSION["portafolios_context"] = array("filter"=>$filter);
      }
      $data["fltNombre"] = $filter;
      $data["portafolios"] = obtenerPortafolioPorFiltro($filter,'%');
      renderizar("portafolios/portafolios", $data );
  }

  run();
;
?>
