<?php

  /* programa Controller
   * 2017-06-20
   * Created By JCHR14
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
  require_once('models/mantenimientos/programas.model.php');
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
    $viewData["tipoProgramas"]= getTiposProgramas();
    $viewData["estadoProgramas"]= getEstadoProgramas();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
          $viewData["programacod"] =$_GET["programacod"];
          switch ($viewData["mode"]) {
            case 'INS':
              $viewData["modeDesc"] = "Nuevo Programa";
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
            $viewData["programacod"] = $_POST["txtCodigo"];
            $viewData["programadsc"] = $_POST["txtDescripcion"];
            $viewData["programaest"] =  $_POST["cmbEstado"];
            $viewData["programatyp"] =  $_POST["cmbTipo"];


            if(isEmpty($viewData["programadsc"])){
                $viewData["errores"][] = "Descripción en formato Incorrecto";
            }

            $viewData["haserrores"] = count($viewData["errores"]) && true;

            switch ($viewData["mode"]) {
              case 'INS':
                /*    $codigo=$viewData["programacod"];
                    $viewData["codigo"]="";
                    $viewData["codigo"]=obtenerProgramaPorCodigo($codigo);*/

                    /*if(empty($viewData["codigo"])){*/
                      $lastId = insertPrograma($viewData["programacod"],$viewData["programadsc"],
                                    $viewData["programaest"],
                                    $viewData["programatyp"]
                                  );
                  /*  }
                    else{
                      $viewData["errores"][] = "Código de programa ya existe";
                    }*/

                  if($lastId){
                    redirectWithMessage("Programa Creado Satisfactoriamente.", "index.php?page=programas");
                    die();
                  }else{
                    $viewData["errores"][] = "Error al crear el programa";
                    $viewData["haserrores"] = true;
                  }

                $viewData["modeDesc"] = "Nuevo Usuario";
                break;

              case 'UPD':
                if(!$viewData["haserrores"] && !empty($viewData["programacod"])){
                  //Se obtiene el usuario
                  //$programa = obtenerProgramaPorCodigo($viewData["programacod"]);
                  // Se actualiza los datos del usuario
                  $affected = updatePrograma($viewData["programacod"],
                                $viewData["programadsc"],
                                $viewData["programaest"],
                                $viewData["programatyp"]
                              );
                  // Si no hay error se redirige a la lista de usuarios
                  if($affected){
                    redirectWithMessage("Programa Actualizado Satisfactoriamente.", "index.php?page=programas");
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
    if(!empty($viewData["programacod"])){
      $programa = obtenerProgramaPorCodigo($viewData["programacod"]);
      mergeFullArrayTo($programa,$viewData);
      $viewData["modeDesc"] .= $viewData["programacod"];
      $viewData["tipoProgramas"] = addSelectedCmbArray($viewData["tipoProgramas"],"codigo",$viewData["programatyp"]);
      $viewData["estadoProgramas"] = addSelectedCmbArray($viewData["estadoProgramas"],"codigo",$viewData["programaest"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()+"usertr");
      $_SESSION["user_tocken"] = $viewData["tocken"];
    }
    renderizar("mantenimientos/programa", $viewData);
  }

  run();

?>
