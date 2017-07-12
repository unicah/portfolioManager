<?php

   require_once('models/portafolios/colaborador.model.php');
   require_once("libs/validadores.php");
  function run(){

      $viewData =array();





      renderizar("portafolios/colaboradoreditar", $viewData );




  }

  run();

?>
