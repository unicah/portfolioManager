<?php
/*
* Control roles mostrar los roles
* Creado por belzze
*
*/




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
    $viewData["estadoRol"]= getEstadoRol();
    //--------------------------------------
    //Esto es para decirle que va a hacer la pagina porque puede agregar, editar omostrar, no se eliminan solo se desactivan
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
          $viewData["rolescod"] =$_GET["rolescod"];
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
            redirectWithMessage("Accion Solicitada no disponible.", "index.php?page=roles");
            die();
        }
        // tocken para evitar ataques xhr
        $viewData["tocken"] = md5(time()+"usertr");
        $_SESSION["user_tocken"] = $viewData["tocken"];
      }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["user_tocken"]){
         if(isset($_POST["mode"])){
           $viewData["mode"] = $_POST["mode"];
           $viewData["rolescod"] = $_POST["txtCodigo"];
           $viewData["rolesdsc"] = $_POST["txtName"];
           $viewData["rolesest"] =  $_POST["cmbEstado"];


           if(isEmpty($viewData["rolesdsc"])){
               $viewData["errores"][] = "Descripción en formato Incorrecto";
           }

           $viewData["haserrores"] = count($viewData["errores"]) && true;

           switch ($viewData["mode"]) {
             case 'INS':
                     $lastId = insertRol($viewData["rolescod"],$viewData["rolesdsc"],
                                   $viewData["rolesest"]
                                 );

                 if($lastId){
                   redirectWithMessage("Rol Creado Satisfactoriamente.", "index.php?page=roles");
                   die();
                 }else{
                   $viewData["errores"][] = "Error al crear el rol";
                   $viewData["haserrores"] = true;
                 }

               $viewData["modeDesc"] = "Nuevo Rol";
               break;

             case 'UPD':
               if(!$viewData["haserrores"] && !empty($viewData["rolescod"])){
                 $affected = updateRoles($viewData["rolescod"],
                               $viewData["rolesdsc"],
                               $viewData["rolesest"]
                             );
                 // Si no hay error se redirige a la lista de usuarios
                 if($affected){
                   redirectWithMessage("rol Actualizado Satisfactoriamente.", "index.php?page=roles");
                   die();
                 }else{
                 // Se muestra un error sobre la edicion del usuario
                   $viewData["errores"][] = "Error al editar el Rol";
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
               redirectWithMessage("Acción Solicitada no disponible.", "index.php?page=roles");
               die();
           }

         }
       }else{
         //Cambia la seguridad del formulario
         $viewData["tocken"] = md5(time()+"usertr");
         $_SESSION["user_tocken"] = $viewData["tocken"];
         $viewData["errores"][] = "Error para validar información.";
       }
   }





    //Obtiene los datos del usuario y gestiona los valores de los arreglos
    if(!empty($viewData["rolescod"])){
      $roles = obtenerRolesPorCodigo($viewData["rolescod"]);
      mergeFullArrayTo($roles,$viewData);
      $viewData["modeDesc"] .= $viewData["rolescod"];
      $viewData["estadoRol"] = addSelectedCmbArray($viewData["estadoRol"],"codigo",$viewData["rolesest"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()+"usertr");
      $_SESSION["user_tocken"] = $viewData["tocken"];
    }
    renderizar("mantenimientos/rol", $viewData);
  }

run();
 ?>
