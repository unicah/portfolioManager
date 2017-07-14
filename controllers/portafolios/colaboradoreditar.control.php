<?php

  /* User Controller
   * 2017-06-14
   * Created By OJBA
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
   require_once('models/portafolios/colaborador.model.php');
   require_once("libs/validadores.php");
   function run(){
     $viewData =array();
     $viewData["mode"] = "";
     $viewData["modeDesc"] = "";
     $viewData["tocken"] = "";
     $viewData["errores"] = array();
     $viewData["haserrores"] = false;
     $viewData["readonly"] = false;

     $viewData["estadoUsuarios"]= getEstadoUsuario();
     $viewData["rolUsuarios"]= getRolUsuario();

     if($_SERVER["REQUEST_METHOD"] == "GET"){
         if(isset($_GET["mode"])){
           $viewData["mode"] = $_GET["mode"];
           $viewData["usrcod"] =$_GET["usrcod"];
           switch ($viewData["mode"]) {
             case 'INS':
               $viewData["modeDesc"] = "Nueva Colaborador";
               break;
             case 'UPD':
               $viewData["modeDesc"] = "Editar ";
               //$viewData["readonly"] = 'readonly="readonly"';
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
           $viewData["tocken"] = md5(time()+"usertr");
           $_SESSION["user_tocken"] = $viewData["tocken"];
         }
      }

      //------------------------------------------------------------------/
           if($_SERVER["REQUEST_METHOD"] == "POST"){
              if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["user_tocken"]){
                if(isset($_POST["mode"])){
                  $viewData["mode"] = $_POST["mode"];
                  $viewData["portafoliocodigo"] =$_SESSION["portafoliocodigo"];
                  //$viewData["categoriaportafolio"] = $_POST["txtCodigoCategoria"];
                  $viewData["usrcod"] = intval($_POST["usrcod"]);
                  $viewData["rolportafolionombre"] = $_POST["cmbTipo"];
                  $viewData["colaboradorportafolioestado"] =  $_POST["cmbEstado"];


                  if(isEmpty($viewData["rolportafolionombre"])){
                      $viewData["errores"][] = "Descripción en formato Incorrecto";
                  }

                  $viewData["haserrores"] = count($viewData["errores"]) && true;

                  switch ($viewData["mode"]) {
                    case 'INS':
                            $lastId = insertCategoria($viewData["categoriaportafolio"], $viewData["portafoliocodigo"],
                                          $viewData["categoriaportafolionombre"],
                                          $viewData["categoriaportafolioestado"]
                                        );
                        /*  }
                          else{
                            $viewData["errores"][] = "Código de programa ya existe";
                          }*/

                        if($lastId){
                          redirectWithMessage("Categoria Creado Satisfactoriamente.", "index.php?page=portafolioww");
                          die();
                        }else{
                          $viewData["errores"][] = "Error al crear el programa";
                          $viewData["haserrores"] = true;
                        }

                      $viewData["modeDesc"] = "Nuevo Usuario";
                      break;
                    //____________________________________________________________//
                    case 'UPD':
                      $viewData["readonly"] = 'readonly="readonly"';
                      if(!$viewData["haserrores"] && !empty($viewData["rolportafolionombre"])){
                        //Se obtiene el usuario
                        //$programa = obtenerProgramaPorCodigo($viewData["programacod"]);
                        // Se actualiza los datos del usuario
                        $affected = updateColaboradores($viewData["portafoliocodigo"], $viewData["usrcod"], $viewData["rolportafolionombre"],
                                      $viewData["colaboradorportafolioestado"]
                                    );
                        // Si no hay error se redirige a la lista de categorias
                        if($affected){
                          redirectWithMessage("Categoria Actualizado Satisfactoriamente.", "index.php?page=portafolioww");
                          die();
                        }else{
                        // Se muestra un error sobre la edicion de la categoria
                          $viewData["errores"][] = "Error al editar la categoria";
                          $viewData["haserrores"] = true;
                        }

                      //  redirectWithMessage("Categoria Actualizado Satisfactoriamente.".$viewData["portafoliocodigo"].$viewData["usrcod"].$viewData["rolportafolionombre"].$viewData["colaboradorportafolioestado"], "index.php?page=portafolioww");

                      }

                      //________________________________________________________//
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
                $viewData["tocken"] = md5(time()+"usertr");
                $_SESSION["user_tocken"] = $viewData["tocken"];
                $viewData["errores"][] = "Error para validar información.";
              }
          }
//------------------------------------------------------------------/
if($viewData["usrcod"]>0){
  $usuario = obtenerUsuarioPorCodigo($viewData["usrcod"]);
  mergeFullArrayTo($usuario,$viewData);
  $viewData["modeDesc"] .= $viewData["usuarionom"];
  $viewData["tipoUsuarios"] = addSelectedCmbArray($viewData["rolUsuarios"],"codigo",$viewData["usuariotipo"]);
  $viewData["estadoUsuarios"] = addSelectedCmbArray($viewData["estadoUsuarios"],"codigo",$viewData["usuarioest"]);
}
// Cambia la seguridad del formulario para evitar ataques XHR.
if($viewData["haserrores"]>0){
  $viewData["tocken"] = md5(time()+"usertr");
  $_SESSION["user_tocken"] = $viewData["tocken"];
}




//---------------------------------------------------------------/
  renderizar("portafolios/colaboradoreditar", $viewData );

  }

  run();

?>
