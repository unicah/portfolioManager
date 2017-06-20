<?php
/* Home Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */

  function run(){
    $arregloAVista = array();
    $arregloAVista["nombreCompleto"] = "Orlando Betancourth";
    renderizar("portafolios/portafolio",$arregloAVista);
  }


  run();
?>
