<?php
/*
* Control roles mostrar los roles
* Creado por belzze
*
*/

  require_once('models/mantenimiento/mantenimiento.model.php');
  require_once("libs/validadores.php");
  function run(){
    $viewData =array();
    $viewData["mode"] = "";
    $viewData["modeDesc"] = "";
    $viewData["tocken"] = "";
    $viewData["errores"] = array();
    $viewData["haserrores"] = false;
    $viewData["readonly"] = false;

    //Arreglo para el combo de Estado de roles
    $viewData["estadoRol"]= getEstadoRol();
    //--------------------------------------
    //Esto es para decirle que va a hacer la pagina porque puede agregar, editar omostrar, no se eliminan solo se desactivan
    if($_SERVER["REQUEST_METHOD"] == "GET"){
      if(isset($_GET["mode"])){
        $viewData["mode"] = $_GET["mode"];
        $viewData["rlscod"] = intval($_GET["rlscod"]);
        switch ($viewData["mode"]) {
          case 'INS':
            $viewData["modeDesc"] = "Nuevo Rol";
            break;
          case 'UPD':
            $viewData["modeDesc"] = "Editar ";
            break;
          case 'DEL':
            $viewData["modeDesc"] = "Eliminar ";
            break;
          case 'DSP':
            $viewData["modeDesc"] = "Detalle de ";
            $viewData["readonly"] = 'readonly="readonly"';
            break;
          default:
            redirectWithMessage("Accion Solicitada no disponible.", "index.php?page=users");
            die();
        }
        // tocken para evitar ataques xhr
        $viewData["tocken"] = md5(time()+"usertr");
        $_SESSION["user_tocken"] = $viewData["tocken"];
      }
    }
    renderizar("mantenimientos/rol", $viewData);
  }

run();
 ?>
