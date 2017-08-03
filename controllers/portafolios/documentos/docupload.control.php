<?php
  require_once("libs/validadores.php");
  require_once("models/portafolios/portafolios.model.php");
require_once("models/portafolios/documentos/documentos.model.php");

  function run(){
    $viewData = array();
    $viewData["MODE"]="";
    $viewData["modeDesc"]="";
    $viewData["tocken"]="";
    $viewData["errores"]="";
    $viewData["haserrores"]=false;
    $viewData["readonly"]=false;

    $viewData["documentoportafoliocodigo"]='';
    $viewData["documentodescripcion"]='';
    $viewData["documentoportafolioobservacion"]='';
    $viewData["categoriaportafolio"]='';
    $viewData["documentoportafolioflujoactual"]='';

    $viewData["categorias"]=obtenerCategoriasPortafolio($_SESSION["portafoliocodigo"]);
    $viewData["flujos"]=obtenerFlujosPortafolio($_SESSION["portafoliocodigo"]);



    //

    if($_SERVER["REQUEST_METHOD"] == "GET"){
      if(isset($_GET["mode"])){
        $viewData["mode"] = $_GET["mode"];
        $viewData["doccod"] =0;//$_GET["doccod"];
        switch ($viewData["mode"]) {
          case 'INS':
             $viewData["modeDesc"] = "Nuevo Documento";
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
       $viewData["tocken"] = md5(time()+"docuploadtrn");
       $_SESSION["docupload_tocken"] = $viewData["tocken"];
     }
    }
 //-----------------------------------------------------
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["docupload_tocken"]){
      if(isset($_POST["mode"])){
        $viewData["mode"] = $_POST["mode"];
        $viewData["doccod"] = $_POST["doccod"];


        $viewData["documentoportafoliocodigo"]= $_POST["documentoportafoliocodigo"];
        $viewData["documentodescripcion"]=  $_POST["documentodescripcion"];
        $viewData["documentoportafolioobservacion"]=  $_POST["documentoportafolioobservacion"];
        $viewData["categoriaportafolio"]=  $_POST["categoriaportafolio"];
        $viewData["documentoportafolioflujoactual"]=  $_POST["documentoportafolioflujoactual"];

        //Validaciones
        if(isEmpty($viewData["documentoportafoliocodigo"])){
          $viewData["errores"][] = "Código del Documento no puede ir vacio.";
          $viewData["haserrores"] = true;
        }

        if(isEmpty($viewData["documentodescripcion"])){
          $viewData["errores"][] = "Se requiere una Descripción del Documento.";
          $viewData["haserrores"] = true;
        }



        switch ($viewData["mode"]) {
          case 'INS':
              //Insertar el documento
              $lastId = false;

              //Determinando si viene el archivo
              if(isset($_FILES["uploadfile"])){
                //Obtenemos los datos necesarios para generar el registro
                $udir = "uploads/"; // directorio a donde guardaremos el documento
                $fname = basename($_FILES["uploadfile"]["name"]); //El nombre del archivo
                $fsize = $_FILES["uploadfile"]["size"]; //tamaño en bytes
                //Se puede validar el tamano del archivo
                $tfil =  $udir . md5($fname.time()); //guardamos el archivo con  hash para evitar intruciones directas
                move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $tfil); //movemos el archivo para guardar en la carpeta




                if(!$viewData["haserrores"]){
                  $lastId = insertarNuevoDocumentoPortafolio(
                    $_SESSION["portafoliocodigo"],
                    $viewData["documentoportafoliocodigo"],
                    $viewData["documentodescripcion"],
                    $viewData["documentoportafolioobservacion"],
                    $viewData["categoriaportafolio"],
                    $viewData["documentoportafolioflujoactual"],
                    $tfil,
                    $fname
                  );

                  if($lastId){
                    redirectWithMessage("Documento Creado Satisfactoriamente.", "index.php?page=portafolioww");
                    die();
                  }else{
                    $viewData["errores"][] = "Error al crear el Documento";
                    $viewData["haserrores"] = true;
                    $viewData["modeDesc"] = "Nuevo Documento";
                  }
                }
              }else{
                $viewData["errores"][] = "Debe adjuntar un documento";
                $viewData["haserrores"] = true;
              }





            break;

          case 'UPD':
            if(!$viewData["haserrores"] && !empty($viewData["doccod"])){
              // $affected = updateRoles($viewData["departamentocodigo"],
              //               $viewData["departmanetodesc"],
              //               $viewData["departamentoest"]
              //             );
              // Si no hay error se redirige a la lista de usuarios
              if($affected){
                redirectWithMessage("Documento Actualizado Satisfactoriamente.", "index.php?page=portafolioww");
                die();
              }else{
              // Se muestra un error sobre la edicion del usuario
                $viewData["errores"][] = "Error al editar el Documento";
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
      $viewData["tocken"] = md5(time()+"docuploadtrn");
      $_SESSION["docupload_tocken"] = $viewData["tocken"];
      $viewData["errores"][] = "Error para validar información.";
    }
 }
 //-----------------------------------------------------
 if($viewData["doccod"]>0){
   //$departamento = obtenerDepartamentoPorCodigo($viewData["doccod"]);
   //mergeFullArrayTo($departamento,$viewData);

   $viewData["modeDesc"] .= ''; //$viewData["departmanetodesc"];
   //$viewData["tipoUsuarios"] = addSelectedCmbArray($viewData["tipoUsuarios"],"codigo",$viewData["usuariotipo"]);
   //$viewData["estadoUsuarios"] = addSelectedCmbArray($viewData["estadoUsuarios"],"codigo",$viewData["departamentoest"]);
 }
 // Cambia la seguridad del formulario para evitar ataques XHR.
 if($viewData["haserrores"]>0){
   $viewData["tocken"] = md5(time()+"docuploadtrn");
   $_SESSION["docupload_tocken"] = $viewData["tocken"];
 }


    renderizar("portafolios/documentos/docupload",$viewData);
  }


  run();
?>
