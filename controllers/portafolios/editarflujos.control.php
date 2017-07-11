<?php
  require_once('models/mantenimientos/mantenimiento.model.php');
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
//    $viewData["estadoRol"]= getEstadoRol();
    //--------------------------------------
    //Esto es para decirle que va a hacer la pagina porque puede agregar, editar omostrar, no se eliminan solo se desactivan
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
          $viewData["code"] =$_GET["code"];
          switch ($viewData["mode"]) {
            case 'INS':
              $viewData["modeDesc"] = "Nuevo flujo";
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
            redirectWithMessage("Accion Solicitada no disponible.", "index.php?page=portafolioww");
            die();
        }
        // tocken para evitar ataques xhr
        $viewData["tocken"] = md5(time()+"flujostr");
        $_SESSION["flujos_tocken"] = $viewData["tocken"];
      }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["flujos_tocken"]){
         if(isset($_POST["mode"])){
           $viewData["mode"] = $_POST["mode"];
           $viewData["code"] = $_POST["code"];
           $viewData["flujosdsc"] = $_POST["txtName"];
           $viewData["flujosest"] =  $_POST["cmbEstado"];


           if(isEmpty($viewData["flujosdsc"])){
               $viewData["errores"][] = "Descripción en formato Incorrecto";
           }

           $viewData["haserrores"] = count($viewData["errores"]) && true;

           switch ($viewData["mode"]) {
             case 'INS':
                     $lastId = insertRol($viewData["code"],$viewData["flujosdsc"],
                                   $viewData["flujosest"]
                                 );

                 if($lastId){
                   redirectWithMessage("Flujo Creado Satisfactoriamente.", "index.php?page=portafolioww");
                   die();
                 }else{
                   $viewData["errores"][] = "Error al cambiar el flujo";
                   $viewData["haserrores"] = true;
                 }

               $viewData["modeDesc"] = "Nuevo flujo";
               break;

             case 'UPD':
               if(!$viewData["haserrores"] && !empty($viewData["code"])){
                 $affected = updateRoles($viewData["code"],
                               $viewData["flujosdsc"],
                               $viewData["flujosest"]
                             );
                 // Si no hay error se redirige a la lista de usuarios
                 if($affected){
                   redirectWithMessage("Flujos Actualizado Satisfactoriamente.", "index.php?page=portafolioww");
                   die();
                 }else{
                 // Se muestra un error sobre la edicion del usuario
                   $viewData["errores"][] = "Error al editar el flujo";
                   $viewData["haserrores"] = true;
                 }
               }
               $viewData["modeDesc"] = "Editar ";
               break;
             case 'DEL':
               $viewData["modeDesc"] = "Eliminar ";
               //No se implementará
               break;
             case 'DSP':
               $viewData["modeDesc"] = "Detalle de ";
               $viewData["readonly"] = 'readonly="readonly"';
               break;
             default:
               redirectWithMessage("Acción Solicitada no disponible.", "index.php?page=portafolioww");
               die();
           }

         }
       }else{
         //Cambia la seguridad del formulario
         $viewData["tocken"] = md5(time()+"flujostr");
         $_SESSION["flujos_tocken"] = $viewData["tocken"];
         $viewData["errores"][] = "Error para validar información.";
       }
   }





    //Obtiene los datos del usuario y gestiona los valores de los arreglos
    if(!empty($viewData["code"])){
      $flujos = obtenerflujosPorCodigo($viewData["code"]);
      mergeFullArrayTo($flujos,$viewData);
      $viewData["modeDesc"] .= $viewData["code"];
    //  $viewData["estadoRol"] = addSelectedCmbArray($viewData["estadoRol"],"codigo",$viewData["rolesest"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()+"flujostr");
      $_SESSION["flujos_tocken"] = $viewData["tocken"];
    }
    renderizar("mantenimientos/rol", $viewData);
  }

run();
 ?>
