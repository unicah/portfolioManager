<?php
require_once("libs/dao.php");

function obtenerProgramasPorFiltro($programacod, $Typ){
    $programas = array();
    $sqlstr = sprintf("SELECT *FROM programas where programacod like '%s' and programatyp like '%s';",
       $programacod.'%' , $Typ);
    $programas = obtenerRegistros($sqlstr);
    return $programas;
}

 ?>
