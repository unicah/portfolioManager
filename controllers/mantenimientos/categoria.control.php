<?php

  /* programa Controller
   * 2017-07-06
   * Created By JCHR14
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
  require_once('models/mantenimientos/categorias.model.php');
  require_once("libs/validadores.php");
  function run(){
    $viewData =array();
    $viewData["mode"] = "";
    $viewData["modeDesc"] = "";
    $viewData["tocken"] = "";
    $viewData["errores"] = array();
    $viewData["haserrores"] = false;
    $viewData["readonly"] = false;
    /*
    INSERT INTO `portfoliomanager`.`portafolio_categoria`
    (`categoriaportafolio`, `portafoliocodigo`, `categoriaportafolionombre`,
     `categoriaportafolioestado`) VALUES (NULL, NULL, NULL, NULL);
    */

    //Arreglo para el combo de Tipos de usuario
    $viewData["estadoCategoria"]= getEstadoCategoria();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["mode"])){
          $viewData["mode"] = $_GET["mode"];
          $viewData["categoriaportafolio"] =$_GET["code"];
          switch ($viewData["mode"]) {
            case 'INS':
              $viewData["modeDesc"] = "Nueva Categoria";
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
          $viewData["tocken"] = md5(time()+"usertr");
          $_SESSION["user_tocken"] = $viewData["tocken"];
        }
     }

     if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["user_tocken"]){
          if(isset($_POST["mode"])){
            $viewData["mode"] = $_POST["mode"];
            $viewData["portafoliocodigo"] =$_SESSION["portafoliocodigo"];
            $viewData["categoriaportafolio"] = $_POST["txtCodigoCategoria"];
            $viewData["categoriaportafolionombre"] = $_POST["txtNombre"];
            $viewData["categoriaportafolioestado"] =  $_POST["cmbEstado"];


            if(isEmpty($viewData["categoriaportafolionombre"])){
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

              case 'UPD':
                $viewData["readonly"] = 'readonly="readonly"';
                if(!$viewData["haserrores"] && !empty($viewData["categoriaportafolio"])){
                  //Se obtiene el usuario
                  //$programa = obtenerProgramaPorCodigo($viewData["programacod"]);
                  // Se actualiza los datos del usuario
                  $affected = updateCategoria($viewData["categoriaportafolio"],
                                $viewData["categoriaportafolioestado"]
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
          $viewData["tocken"] = md5(time()+"usertr");
          $_SESSION["user_tocken"] = $viewData["tocken"];
          $viewData["errores"][] = "Error para validar información.";
        }
    }

    //Obtiene los datos del usuario y gestiona los valores de los arreglos
    if(!empty($viewData["categoriaportafolio"])){
      $programa = obtenerCategoriaPorCodigo($viewData["categoriaportafolio"]);
      mergeFullArrayTo($programa,$viewData);
      $viewData["modeDesc"] .= $viewData["categoriaportafolionombre"];
      $viewData["estadoCategoria"] = addSelectedCmbArray($viewData["estadoCategoria"],"codigo",$viewData["categoriaportafolioestado"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()+"usertr");
      $_SESSION["user_tocken"] = $viewData["tocken"];
    }
    renderizar("mantenimientos/categoria", $viewData);
  }

  run();

?>
