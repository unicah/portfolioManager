<?php
<<<<<<< refs/remotes/unicah/develop
/* Programas Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */
 require_once("models/mantenimientos/departamento.model.php");
 require_once("libs/validadores.php");
 function run(){
   $viewData =array();
   $viewData["MODE"]="";
   $viewData["modeDesc"]="";
   $viewData["tocken"]="";
   $viewData["errores"]="";
   $viewData["haserrores"]=false;
   $viewData["readonly"]=false;

   $viewData["estadoUsuarios"]= getEstadodepartamento();


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
//-----------------------------------------------------
if($_SERVER["REQUEST_METHOD"] == "POST"){
   if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["user_tocken"]){
     if(isset($_POST["mode"])){
       $viewData["mode"] = $_POST["mode"];
       $viewData["departamentocodigo"] = $_POST["txtCodigo"];
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
               redirectWithMessage("departamento Creado Satisfactoriamente.", "index.php?page=departamentos");
               die();
             }else{
               $viewData["errores"][] = "Error al crear el departamento";
               $viewData["haserrores"] = true;
             }

           $viewData["modeDesc"] = "Nuevo departamento";
           break;

         case 'UPD':
           if(!$viewData["haserrores"] && !empty($viewData["departamentocodigo"])){
             $affected = updateRoles($viewData["departamentocodigo"],
                           $viewData["departmanetodesc"],
                           $viewData["departamentoest"]
                         );
             // Si no hay error se redirige a la lista de usuarios
             if($affected){
               redirectWithMessage("departamento Actualizado Satisfactoriamente.", "index.php?page=departamentos");
               die();
             }else{
             // Se muestra un error sobre la edicion del usuario
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
           redirectWithMessage("Acción Solicitada no disponible.", "index.php?page=departamento");
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
//-----------------------------------------------------
if($viewData["depcod"]>0){
  $departamento = obtenerDepartamentoPorCodigo($viewData["depcod"]);
  mergeFullArrayTo($departamento,$viewData);
  $viewData["modeDesc"] .= $viewData["departmanetodesc"];
  //$viewData["tipoUsuarios"] = addSelectedCmbArray($viewData["tipoUsuarios"],"codigo",$viewData["usuariotipo"]);
  $viewData["estadoUsuarios"] = addSelectedCmbArray($viewData["estadoUsuarios"],"codigo",$viewData["departamentoest"]);
}
// Cambia la seguridad del formulario para evitar ataques XHR.
if($viewData["haserrores"]>0){
  $viewData["tocken"] = md5(time()+"usertr");
  $_SESSION["user_tocken"] = $viewData["tocken"];
}

//-----------------------------------------------------
  renderizar("mantenimientos/departamento", $viewData);
 }


run();

=======

  /* programa Controller
   * 2017-06-28
   * Created By JCHR14
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
  require_once('models/mantenimientos/departamentos.model.php');
  require_once("libs/validadores.php");
  function run(){
    $viewData =array();
    $viewData["mode"] = "";
    $viewData["modeDesc"] = "";
    $viewData["tocken"] = "";
    $viewData["errores"] = array();
    $viewData["haserrores"] = false;
    $viewData["readonly"] = false;

    //Arreglo para el combo de Tipos de usuario
    $viewData["estadoDepartamento"]= getEstadoDepartamentos();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
          $viewData["departamentocodigo"] =$_GET["departamentocodigo"];
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
            $viewData["departamentodesc"] = $_POST["txtDescripcion"];
            $viewData["departamentoest"] =  $_POST["cmbEstado"];

            $viewData["haserrores"] = count($viewData["errores"]) && true;

            switch ($viewData["mode"]) {
              case 'INS':
                      $lastId = insertDepartamento($viewData["departamentodesc"],
                                    $viewData["departamentoest"]
                                  );
                  if($lastId){
                    redirectWithMessage("Departamento Creado Satisfactoriamente.", "index.php?page=departamentos");
                    die();
                  }else{
                    $viewData["errores"][] = "Error al crear el Departamento";
                    $viewData["haserrores"] = true;
                  }

                $viewData["modeDesc"] = "Nuevo Departamento";
                break;

              case 'UPD':
                if(!$viewData["haserrores"] && $viewData["departamentocodigo"]>0){

                  $affected = updateDepartamento($viewData["departamentocodigo"],
                                $viewData["departamentodesc"],
                                $viewData["departamentoest"]
                              );
                  // Si no hay error se redirige a la lista de usuarios
                  if($affected){
                    redirectWithMessage("Departamento Actualizado Satisfactoriamente.", "index.php?page=departamentos");
                    die();
                  }else{
                  // Se muestra un error sobre la edicion del usuario
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
                redirectWithMessage("Acción Solicitada no disponible.", "index.php?page=programas");
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
    if($viewData["departamentocodigo"]>0){
      $departamento = obtenerDepartamentoPorCodigo($viewData["departamentocodigo"]);
      mergeFullArrayTo($departamento,$viewData);
      $viewData["modeDesc"] .= $viewData["departamentocodigo"];
      $viewData["estadoDepartamento"] = addSelectedCmbArray($viewData["estadoDepartamento"],"codigo",$viewData["departamentoest"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()+"usertr");
      $_SESSION["user_tocken"] = $viewData["tocken"];
    }
    renderizar("mantenimientos/departamento", $viewData);
  }

  run();
>>>>>>> Auto stash before rebase of "origin/develop"

?>
