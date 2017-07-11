<?php
/* Home Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */
 require_once("models/support/bitacora.model.php");
  function run(){
    $arregloAVista = array();
    $arregloAVista["fltprograma"] = "";
    $arregloAVista["fltTipo"] = "ALL";
    $arregloAVista["fltMes"] = "3";
    $arregloAVista["fltShowObs"] = "0";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $arregloAVista["fltprograma"] = $_POST["fltprograma"];;
      $arregloAVista["fltTipo"] = $_POST["fltTipo"];
      $arregloAVista["fltMes"] = $_POST["fltMes"];
      $arregloAVista["fltShowObs"] = $_POST["fltShowObs"];
      $_SESSION["bitacora_context"] = $arregloAVista;
    }else{
      if(isset($_SESSION["bitacora_context"])){
        $arregloAVista = $_SESSION["bitacora_context"];
      }
    }

    $arregloAVista["showobs"] = ($arregloAVista["fltShowObs"] === "1");
    $arregloAVista["fltTipos"] = addSelectedCmbArray(getTiposBitacora(),"codigo",$arregloAVista["fltTipo"]);
    $arregloAVista["fltMeses"] = addSelectedCmbArray(getMesesBitacora(),"codigo",$arregloAVista["fltMes"]);

    $bitacoras = obtenerBitacoras($arregloAVista["fltprograma"],$arregloAVista["fltTipo"],
                    $arregloAVista["fltMes"],  $arregloAVista["showobs"] );

    $arregloAVista["bitacoras"] = array();
    foreach($bitacoras as $bitacora){
      $bitacora["jsonpretty"] = json_encode(json_decode($bitacora["bitobservacion"]),JSON_PRETTY_PRINT);
      $bitacora["showobs"] = $arregloAVista["showobs"];
      $arregloAVista["bitacoras"][] = $bitacora;
    }

    renderizar("support/bitacora",$arregloAVista);
  }


  run();
?>
