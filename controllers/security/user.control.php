<?php

  /* User Controller
   * 2017-06-14
   * Created By OJBA
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
  require_once('models/security/security.model.php');
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
    $viewData["tipoUsuarios"]= getTiposUsuario();
    $viewData["estadoUsuarios"]= getEstadoUsuario();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
          $viewData["usrcod"] = intval($_GET["usrcod"]);
          switch ($viewData["mode"]) {
            case 'INS':
              $viewData["modeDesc"] = "Nuevo Usuario";
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

     if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["user_tocken"]){
          if(isset($_POST["mode"])){
            $viewData["mode"] = $_POST["mode"];
            $viewData["usrcod"] = intval($_POST["usrcod"]);
            $viewData["usuarioemail"] = $_POST["txtCorreo"];
            $viewData["usuarionom"] = $_POST["txtName"];
            $viewData["usuariotipo"] =  $_POST["cmbTipo"];
            $viewData["usuarioest"] =  $_POST["cmbEstado"];
            $viewData["usuariopswd"] =  $_POST["txtPswd"];


            // Validar la data
            if(!isValidEmail($viewData["usuarioemail"])){
                $viewData["errores"][] = "Correo Incorrecto";
            }
            if(!isValidText($viewData["usuarionom"]) || isEmpty($viewData["usuarionom"])){
                $viewData["errores"][] = "Nombre en formato Incorrecto";
            }
            if((isEmpty($viewData["usuariopswd"]) && $viewData["mode"] =="INS" )){
                $viewData["errores"][] = "Contraseña en formato incorrecto";
            }
            if((!isEmpty($viewData["usuariopswd"]) && $viewData["mode"] =="UPD" )){
                if(!isValidPassword($viewData["usuariopswd"])){
                    $viewData["errores"][] = "Contraseña en formato incorrecto";
                }
            }

            $viewData["haserrores"] = count($viewData["errores"]) && true;

            switch ($viewData["mode"]) {
              case 'INS':
                if(!$viewData["haserrores"] && $viewData["usrcod"] == 0){
                  //Se genera la contraseña salada y encriptada
                  $fchingreso = time();
                  $pswdSalted = "";
                  if($fchingreso % 2 == 0){
                    $pswdSalted = $viewData["usuariopswd"] . $fchingreso;
                  }else{
                    $pswdSalted = $fchingreso . $viewData["usuariopswd"];
                  }
                  $pswdSalted = md5($pswdSalted);
                  $lastId = insertUsuario($viewData["usuarionom"],
                                $viewData["usuarioemail"],
                                $fchingreso,
                                $pswdSalted,
                                $viewData["usuariotipo"],
                                $viewData["usuarioest"]
                              );
                  if($lastId){
                    redirectWithMessage("Usuario Creado Satisfactoriamente.", "index.php?page=users");
                    die();
                  }else{
                    $viewData["errores"][] = "Error al crear el usuario";
                    $viewData["haserrores"] = true;
                  }
                }
                $viewData["modeDesc"] = "Nuevo Usuario";
                break;
              case 'UPD':
                if(!$viewData["haserrores"] && $viewData["usrcod"] > 0){
                  //Se obtiene el usuario
                  $usuario = obtenerUsuarioPorCodigo($viewData["usrcod"]);
                  $pswdSalted='';
                  // Si no hay cambo de contraseña se usa la anterior
                  if(isEmpty($viewData["usuariopswd"])){
                    $pswdSalted = $usuario["usuariopswd"];
                  }else{
                    //Se genera nueva contraseña salando el valor cambiado
                    $fchingreso = $usuario['usuariofching'];
                    $pswdSalted = "";
                    if($fchingreso % 2 == 0){
                      $pswdSalted = $viewData["usuariopswd"] . $fchingreso;
                    }else{
                      $pswdSalted = $fchingreso . $viewData["usuariopswd"];
                    }
                    $pswdSalted = md5($pswdSalted);
                  }
                  // Se actualiza los datos del usuario
                  $affected = updateUsuario($viewData["usrcod"],
                                $viewData["usuarionom"],
                                $viewData["usuarioemail"],
                                $pswdSalted,
                                $viewData["usuariotipo"],
                                $viewData["usuarioest"]
                              );
                  // Si no hay error se redirige a la lista de usuarios
                  if($affected){
                    redirectWithMessage("Usuario Actualizado Satisfactoriamente.", "index.php?page=users");
                    die();
                  }else{
                  // Se muestra un error sobre la edicion del usuario
                    $viewData["errores"][] = "Error al editar el usuario";
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
                redirectWithMessage("Acción Solicitada no disponible.", "index.php?page=users");
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
    if($viewData["usrcod"]>0){
      $usuario = obtenerUsuarioPorCodigo($viewData["usrcod"]);
      mergeFullArrayTo($usuario,$viewData);
      $viewData["modeDesc"] .= $viewData["usuarionom"];
      $viewData["tipoUsuarios"] = addSelectedCmbArray($viewData["tipoUsuarios"],"codigo",$viewData["usuariotipo"]);
      $viewData["estadoUsuarios"] = addSelectedCmbArray($viewData["estadoUsuarios"],"codigo",$viewData["usuarioest"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()+"usertr");
      $_SESSION["user_tocken"] = $viewData["tocken"];
    }
    renderizar("security/user", $viewData);
  }

  run();

?>
