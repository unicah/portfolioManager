<?php
  require_once('models/portafolios/editarflujos.model.php');
  require_once("libs/validadores.php");
  function run(){
    $viewData =array();
    $viewData["mode"] = "";
    $viewData["modeDesc"] = "";
    $viewData["tocken"] = "";
    $viewData["errores"] = array();
    $viewData["haserrores"] = false;
    $viewData["readonly"] = false;

    //Arreglo para el combo de Estado de flujos
    $viewData["estadoflujo"]= getEstadoflujo();
    //--------------------------------------
    //Esto es para decirle que va a hacer la pagina porque puede agregar, editar omostrar, no se eliminan solo se desactivan
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
          $viewData["flujoportafolio"] =$_GET["code"];
          switch ($viewData["mode"]) {
            case 'INS':
              $viewData["modeDesc"] = "Nuevo flujo";
              break;
            case 'UPD':
              $viewData["modeDesc"] = "Editar ";
              $viewData["readonly"] = 'readonly="readonly"';
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
        $viewData["tocken"] = md5(time()+"flujotr");
      $_SESSION["flujo_tocken"] = $viewData["tocken"];
      }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["flujo_tocken"]){
         if(isset($_POST["mode"])){
           $viewData["mode"] = $_POST["mode"];
           $viewData["portafoliocodigo"]=$_SESSION["portafoliocodigo"];
           $viewData["flujoportafolio"] = $_POST["txtCodigo"];
           $viewData["flujosdsc"] = $_POST["txtName"];
           $viewData["flujoportafolioestado"] =  $_POST["cmbEstado"];


           if(isEmpty($viewData["flujosdsc"])){
               $viewData["errores"][] = "Descripción en formato Incorrecto";
           }

           $viewData["haserrores"] = count($viewData["errores"]) && true;

           switch ($viewData["mode"]) {
             case 'INS':
                     $lastId = insertflujo2($viewData["flujoportafolio"], $viewData["portafoliocodigo"], $viewData["flujosdsc"], $viewData["flujoportafolioestado"]
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
                $viewData["readonly"] = 'readonly="readonly"';
               if(!$viewData["haserrores"] && !empty($viewData["flujoportafolio"])){
                 $affected = updateflujo($viewData["flujoportafolio"],$viewData["portafoliocodigo"],$viewData["flujoportafolioestado"]
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
         $viewData["tocken"] = md5(time()+"flujotr");
         $_SESSION["flujo_tocken"] = $viewData["tocken"];
         $viewData["errores"][] = "Error para validar información.";
       }
   }





    //Obtiene los datos del usuario y gestiona los valores de los arreglos
    if(!empty($viewData["flujoportafolio"])){
      $flujos = obtenerflujosPorCodigo($viewData["flujoportafolio"]);
      mergeFullArrayTo($flujos,$viewData);
      $viewData["modeDesc"] .= $viewData["flujoportafolio"];
      $viewData["estadoflujo"] = addSelectedCmbArray($viewData["estadoflujo"],"codigo",$viewData["flujoportafolioestado"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()+"flujotr");
      $_SESSION["flujo_tocken"] = $viewData["tocken"];
    }
    renderizar("portafolios/editarflujos", $viewData);
  }

run();
 ?>
