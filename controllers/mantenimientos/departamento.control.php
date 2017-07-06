<?php
/*
* Control departamento mostrar los departamento
*
*
*/




  require_once('models/mantenimientos/departamento.model.php');
  require_once("libs/validadores.php");
  function run(){
    $viewData =array();
    $viewData["mode"] = "";
    $viewData["modeDesc"] = "";
    $viewData["tocken"] = "";
    $viewData["errores"] = array();
    $viewData["haserrores"] = false;
    $viewData["readonly"] = false;

    //Arreglo para el combo de Estado de Departamentos
    $viewData["estadoUsuarios"]= getEstadodepartamento();
    //--------------------------------------
    //Esto es para decirle que va a hacer la pagina porque puede agregar, editar omostrar, no se eliminan solo se desactivan
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
          $viewData["depcod"] =$_GET["depcod"];
          switch ($viewData["mode"]) {
            case 'INS':
              $viewData["modeDesc"] = "Nuevo Departamento";
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
            redirectWithMessage("Accion Solicitada no disponible.", "index.php?page=departamentos");
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
           $viewData["depcod"] = $_POST["txtCodigo"];
           $viewData["departmanetodesc"] = $_POST["txtdescripcion"];
           $viewData["departamentoest"] =  $_POST["cmbEstado"];


           if(isEmpty($viewData["departmanetodesc"])){
               $viewData["errores"][] = "Descripción en formato Incorrecto";
           }

           $viewData["haserrores"] = count($viewData["errores"]) && true;

           switch ($viewData["mode"]) {
             case 'INS':
                     $lastId = insertardepartamento($viewData["departmanetodesc"],
                                   $viewData["departamentoest"]
                                 );

                 if($lastId){
                   redirectWithMessage("Departamento Creado Satisfactoriamente.", "index.php?page=departamentos");
                   die();
                 }else{
                   $viewData["errores"][] = "Error al crear el departamento";
                   $viewData["haserrores"] = true;
                 }

               $viewData["modeDesc"] = "Nuevo Departamento";
               break;

             case 'UPD':
               if(!$viewData["haserrores"] && !empty($viewData["depcod"])){
                 $affected = updateDerpartamento($viewData["depcod"],
                               $viewData["departmanetodesc"],
                               $viewData["departamentoest"]
                             );
                 // Si no hay error se redirige a la lista de departamento
                 if($affected){
                   redirectWithMessage("Departamento Actualizado Satisfactoriamente.", "index.php?page=departamentos");
                   die();
                 }else{
                 // Se muestra un error sobre la edicion del departamento
                   $viewData["errores"][] = "Error al editar el departamento";
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
               redirectWithMessage("Acción Solicitada no disponible.", "index.php?page=departamentos");
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
    if(!empty($viewData["depcod"])){
      $roles = obtenerDepartamentoPorCodigo($viewData["depcod"]);
      mergeFullArrayTo($roles,$viewData);
      $viewData["modeDesc"] .= $viewData["departmanetodesc"];
      $viewData["estadoUsuarios"] = addSelectedCmbArray($viewData["estadoUsuarios"],"codigo",$viewData["departamentoest"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()+"usertr");
      $_SESSION["user_tocken"] = $viewData["tocken"];
    }
    renderizar("mantenimientos/departamento", $viewData);
  }

run();
 ?>
