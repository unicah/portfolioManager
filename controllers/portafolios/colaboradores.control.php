<?php

  /* colaborador Controller
   * 2017-06-14
   * Created By OJBA
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| 2017-07-11   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
   require_once('models/portafolios/colaborador.model.php');
   require_once("libs/validadores.php");
  function run(){
      $viewData["rolUsuarios"]= getTiposUsuario();
      $data = array();
      $data["fltEmail"] = "";
      $filter = '';
      if(isset($_SESSION["users_context"])){
        $filter = $_SESSION["users_context"]["filter"];
      }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $filter = $_POST["fltEmail"];
        $_SESSION["users_context"] = array("filter"=>$filter);
      }
      $data["fltEmail"] = $filter;
      $data["usuarios"] = obtenerUsuarioPorFiltro($filter,'%');


      //if(!empty($viewData["depcod"])){
      //$roles = obtenerDepartamentoPorCodigo($viewData["depcod"]);
      //mergeFullArrayTo($roles,$viewData);
      //$viewData["modeDesc"] .= $viewData["departmanetodesc"];
    //$viewData["rolUsuarios"] = addSelectedCmbArray($viewData["rolUsuarios"],"0","0");
      //}




      renderizar("portafolios/colaborador", $data );




  }

  run();

?>
