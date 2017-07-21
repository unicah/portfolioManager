<?php
require_once("libs/dao.php");

function obtenerProgramasPorFiltro($programacod, $Typ){
    $programas = array();
    $sqlstr = sprintf("SELECT *FROM programas where programacod like '%s' and programatyp like '%s';",
       $programacod.'%' , $Typ);
    $programas = obtenerRegistros($sqlstr);
    return $programas;
}

function obtenerProgramaPorCodigo($programacod){
    $programa = array();
    $sqlstr = sprintf("SELECT *FROM programas where programacod = '%s';",valstr($programacod));
    $programa = obtenerUnRegistro($sqlstr);
    return $programa;
}

function insertPrograma($programacod,$programadsc, $programaest,
                       $programatyp){
    $strsql = "INSERT INTO `programas` (
        `programacod`,`programadsc`, `programaest`, `programatyp`) VALUES ('%s','%s', '%s','%s');";
    $strsql = sprintf($strsql,valstr($programacod) , $programadsc, $programaest, $programatyp);

    if(ejecutarNonQuery($strsql)){
        return true;
    }
    return 0;
}


function updatePrograma($programacod, $programadsc, $programaest,
                       $programatyp){

    /*
    update programas set programadsc= 'prueba de update', programaest='ACT', programatyp='ADM'
where programacod= 'gabo'
    */

    $strsql = "UPDATE `programas` set
                `programadsc` = '%s', `programaest` = '%s', `programatyp` = '%s'
                where `programacod` = '%s';";
    $strsql = sprintf($strsql, $programadsc, $programaest,$programatyp, valstr($programacod));

    $affected = ejecutarNonQuery($strsql);
    return ($affected > 0);
}


function getTiposProgramas(){
  return array(
    array("codigo"=>"PGR","valor"=>"Programa"),
    array("codigo"=>"FNC","valor"=>"Función")
  );
}

function getEstadoProgramas(){
  return array(
    array("codigo"=>"ACT","valor"=>"Activo"),
    array("codigo"=>"INA","valor"=>"Inactivo")
  );
}

 ?>
