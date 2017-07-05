<?php
<<<<<<< refs/remotes/unicah/develop
/* Programas Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */
require_once ('models/mantenimientos/departamento.model.php');
  function run(){
    $data = array();
    $data["fltDsc"]="";
    $filter="";
    if (isset($_SESSION["departamento_context"])){
      $filter - $_SESSION["departamento_context"]["filter"];
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $filter = $_POST["fltDsc"];
      $_SESSION["departamento_context"] = array("filter"=>$filter);
    }
$data["fltDsc"] = $filter;
$data["departamentos"] = obtenerdepartamentosporfiltros($filter,'%');
    renderizar("mantenimientos/departamentos",$data);
  }


  run();
?>
=======
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
>>>>>>> Auto stash before rebase of "origin/develop"
