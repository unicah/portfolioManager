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

      $viewData["rolUsuarios"]= array("*NO"=>"Lector","*SI"=>"Editor");

      $viewData["fltEmail"] = "";
      $filter = '';
      if(isset($_SESSION["users_context"])){
        $filter = $_SESSION["users_context"]["filter"];
      }
      if(isset($_SESSION["documentoportafolio"])){
          $viewData["documentoportafolio"] = $_SESSION["documentoportafolio"];
          $viewData["portafoliocodigo"] = $_SESSION["portafoliocodigo"];
      }


////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $viewData["mode"] = "INS";
      $iduser = $_POST["usercod"];
      $rol = $_POST["cmbRol"];
      $act = $_POST["mode"];
      switch ($act) {
        case 'INS':
        
          $lastId = insertarColaboradorDocumento($_SESSION["documentoportafolio"], $rol,$iduser);
          break;
        case 'UPD':
          updateColaboradoresDocumento($_SESSION["documentoportafolio"], $iduser, $rol);
          break;
        case 'DEL':
          inactivarColaboradoresDocumento($_SESSION["documentoportafolio"], $iduser);
          break;
     }
    }


      $viewData["fltEmail"] = $filter;


      $temporalarray = obtenerUsuarioNotAddedDocumento($_SESSION["documentoportafolio"],$_SESSION["portafoliocodigo"]);



      foreach ($temporalarray as $value) {
        $x = '<select class="col-md-12" id="cmbRol" name="cmbRol">';
        foreach($viewData["rolUsuarios"] as $key=>$ovalue){
          $slct = ($key==$value["documentoedicion"])?" selected":"";
          $x .= '<option value="'.$key.'"'.$slct.'>'.$ovalue.'</option>';
        }

        $x .= '</select>';
        $value["cmb"] = $x;
        if($value["clbEst"]=="DSP"){
          $value["isUPD"] = false;
        }else{
          $value["isUPD"] = true;
        }
        $viewData["usuarios"][] = $value;
      }
      renderizar("portafolios/colaboradorD", $viewData );

  }

  run();

?>
