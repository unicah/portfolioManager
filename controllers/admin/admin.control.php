<?php
/* Home Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */

  require_once('models/portafolios/portafolios.model.php');
  function run(){
    $viewArray = array();
    $viewArray["misPortafolios"] = obtenerMisPortafolios($_SESSION["userCode"]);
    renderizar("admin/admin",$viewArray);
  }

  run();
?>
