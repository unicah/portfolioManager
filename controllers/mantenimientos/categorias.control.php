<?php
/* PRogramas Controller
 * 2017-06-19
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */
  require_once("models/mantenimientos/categorias.model.php");


  function run(){
      $data = array();
      $data["fltNombre"] = "";
      $filter = '';
      if(isset($_SESSION["categorias_context"])){
        $filter = $_SESSION["categorias_context"]["filter"];
      }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $filter = $_POST["fltNombre"];
        $_SESSION["categorias_context"] = array("filter"=>$filter);
      }
      $data["fltNombre"] = $filter;
      $data["categorias"] = obtenerCategoriasPorFiltro($filter,'%');
      renderizar("mantenimientos/categorias", $data );
  }

  run();
?>
