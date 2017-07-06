<?php

    require_once("libs/dao.php");




    function obtenerRoles($flujoportafolio){
      $flujos = array();
      $sqlstr = sprintf("SELECT 'flujoportafolionombre','flujoportafolioestado' FROM portafolio_flujo WHERE flujoportafolio = %d;",$flujoportafolio);
      $rol = obtenerUnRegistro($sqlstr);
      return $rol;
    }

    }
