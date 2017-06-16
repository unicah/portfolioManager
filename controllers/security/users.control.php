<?php

  /* Users Controller
   * 2017-06-14
   * Created By OJBA
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
   require_once('models/security/security.model.php');
  function run(){
      $data = array();
      $data["usuarios"] = obtenerUsuarioPorFiltro('%','%');
      renderizar("security/users", $data );
  }

  run();

?>
