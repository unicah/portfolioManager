<?php

  /* User Controller
   * 2017-06-14
   * Created By OJBA
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
   require_once('models/security/security.model.php');
  function run(){
    $viewData =array();

     if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
        }
     }
      renderizar("security/user", $viewData);
  }

  run();

?>
