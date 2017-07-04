<?php
require_once("models/mantenimientos/departamentos.model.php");


function run(){
    $data = array();
    $data["fltDescripcion"] = "";
    $filter = '';
    if(isset($_SESSION["departamentos_context"])){
      $filter = $_SESSION["departamentos_context"]["filter"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $filter = $_POST["fltDescripcion"];
      $_SESSION["departamentos_context"] = array("filter"=>$filter);
    }
    $data["fltDescripcion"] = $filter;
    $data["departamento"] = obtenerDepartamentosPorFiltro($filter,'%');
    renderizar("mantenimientos/departamentos", $data );
}

run();


 ?>
