<?php

  /* colaborador Controller
   * 2017-06-14
   * Created By OJBA
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| 2017-07-19   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
   require_once('models/portafolios/colaborador.model.php');
   require_once('models/portafolios/portafolios.model.php');
   require_once("libs/validadores.php");
   function run(){

      $viewData =array();
      $viewData["mode"] = "";
      $viewData["tocken"] = "";
      $viewData["errores"] = array();
      $viewData["haserrores"] = false;
      $viewData["readonly"] = false;
      $viewData["action"] = "UPLOAD1";
      $iduser = "";
      $idpor = 2;

      $viewData["rolUsuarios"]= obtenerRolesPortafolio($_SESSION["portafoliocodigo"]);

      $viewData["fltEmail"] = "";
      $filter = '';
      if(isset($_SESSION["users_context"])){
        $filter = $_SESSION["users_context"]["filter"];
      }

     if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["portacod"])){

          $viewData["portacod"] = intval($_GET["portacod"]);
        }
        else {
        $viewData["action"] = "u";
        }

        $idpor = intval($_GET["portacod"]);

      }

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

if($_SERVER["REQUEST_METHOD"] == "POST"){
if(true){
  if(true){
       $viewData["mode"] = "INS";
        $iduser = $_POST["usercod"];
        $rol = $_POST["cmbRol"];
       switch ($viewData["mode"]) {
         case 'INS':
                 $lastId = insertarColaboradorDocumento($_SESSION["documentoportafolio"], $iduser);
                 redirectWithMessage("Usuario ".$iduser  ." añadido al documento ".$_SESSION["documentoportafolio"] ." Satisfactoriamente.", "index.php?page=docuview");
           break;
       }
     }
   }else{
     //Cambia la seguridad del formulario
     $viewData["tocken"] = md5(time()+"usertr");
     $_SESSION["user_tocken"] = $viewData["tocken"];
     $viewData["errores"][] = "Error para validar información.";
     redirectWithMessage("Invalido", "index.php?page=colaboradores&portacod=".$idpor);
   }
}

      $viewData["fltEmail"] = $filter;

    //  $viewData["usuarios"] = obtenerUsuarioNotAdded(7);

      $temporalarray = obtenerUsuarioNotAddedDocumento($_SESSION["documentoportafolio"]);

      $x = '<select class="col-md-12" id="cmbRol" name="cmbRol">';
      foreach($viewData["rolUsuarios"] as $rol){
      $x .= '<option value="'.$rol["rolportafolio"].'">'.$rol["rolportafolionombre"].'</option>';
      }
      $x .= '</select>';

      foreach ($temporalarray as $value) {
        $value["cmb"] = $x;
        $viewData["usuarios"][] = $value;



      }

      renderizar("portafolios/colaboradorD", $viewData );

  }

  run();

?>
