<?php
/*
* Control roles mostrar los roles
* Creado por belzze
*
*/

  require_once('models/mantenimiento/mantenimiento.model.php');
  function run(){
    $data = array();
    $data["fltDsc"]="";
    $filter = '';
    if(isset($_SESSION["rol_context"])){
      $filter - $_SESSION["rol_context"]["filter"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $filter = $_POST["fltDsc"];
      $_SESSION["roles_context"] = array("filter" =>$filter);
    }
    $data["fltDsc"] = $filter;
    $data["rol"] = obtenerRolesPorFiltro($filter, '%');
    renderizar("mantenimientos/rol", $data);

}
run();
 ?>
