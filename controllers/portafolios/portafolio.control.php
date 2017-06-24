<?php

  /* User Controller
   * 2017-06-14
   * Created By OJBA
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
  require_once('models/portafolios/portafolios.model.php');
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
    $viewData["departamento"]= getDepartamento();
    $viewData["estado"]=  getEstadoPortafolio();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
          $viewData["portafoliocodigo"] = intval($_GET["portafoliocodigo"]);
          switch ($viewData["mode"]) {
            case 'INS':
              $viewData["modeDesc"] = "Nuevo portafolio";
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
              redirectWithMessage("Accion Solicitada no disponible.", "index.php?page=portafolios");
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
            $viewData["portafoliocodigo"] = intval($_POST["portafoliocodigo"]);
            $viewData["portafolionombre"] = $_POST["portafolionombre"];
            $time = time();
            $viewData["portafolioobservacion"] = $_POST["portafolioobservacion"];
            $viewData["portafolioestado"] = $_POST["Cmbportafolioestado"];
            $viewData["departamentocodigo"] =  $_POST["Cmbdepartamentocodigo"];
            // Validar la data

            if(!isValidText($viewData["portafolionombre"]) || isEmpty($viewData["portafolionombre"])){
                $viewData["errores"][] = "Nombre en formato Incorrecto";
            }

            if( isEmpty($viewData["portafolioobservacion"])){
                $viewData["errores"][] = "Nombre en formato Incorrecto";
            }

            $viewData["haserrores"] = count($viewData["errores"]) && true;

            switch ($viewData["mode"]) {
              case 'INS':
                  $lastId = insertPortafolio($viewData["portafolionombre"],
                                $time,
                                $viewData["portafolioobservacion"],
                                $viewData["portafolioestado"],
                                  $viewData["departamentocodigo"]
                              );
                  if($lastId){
                    redirectWithMessage("Portafolio Creado Satisfactoriamente.", "index.php?page=portafolios");
                    die();
                  }else{
                    $viewData["errores"][] = "Error al crear el portafolio";
                    $viewData["haserrores"] = true;
                  }

                $viewData["modeDesc"] = "Nuevo Portafolios";
                break;

              case 'UPD':
                if(!$viewData["haserrores"] && $viewData["portafoliocodigo"] > 0){
                  //Se obtiene el usuario
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
                    redirectWithMessage("Usuario Actualizado Satisfactoriamente.", "index.php?page=portafolios");
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
                redirectWithMessage("Acción Solicitada no disponible.", "index.php?page=portafolios");
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
    if($viewData["portafoliocodigo"]>0){
      $portafolio = obtenerPortafolioPorCodigo($viewData["portafoliocodigo"]);
      mergeFullArrayTo($portafolio,$viewData);
      $viewData["modeDesc"] .= $viewData["portafolionombre"];
      $viewData["departamento"] = addSelectedCmbArray($viewData["departamento"],"codigo",$viewData["departamentocodigo"]);
      $viewData["estado"] = addSelectedCmbArray($viewData["estado"],"codigo",$viewData["portafolioestado"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()+"usertr");
      $_SESSION["user_tocken"] = $viewData["tocken"];
    }
    renderizar("portafolios/portafolio", $viewData);
  }

  run();

?>
