<?php
require_once("libs/dao.php");
/*
select portafolio_categoria.categoriaportafolio,
portafolio_categoria.categoriaportafolionombre,
portafolio_categoria.categoriaportafolioestado,
portafolio.portafolionombre
from portafolio_categoria  inner join portafolio
on portafolio_categoria.portafoliocodigo = portafolio.portafoliocodigo;

*/
function obtenerCategoriasPorFiltro($categorianombre, $Typ){
    $programas = array();
    $sqlstr = sprintf("SELECT portafolio_categoria.categoriaportafolio,
    portafolio_categoria.categoriaportafolionombre,
    portafolio_categoria.categoriaportafolioestado,
    portafolio.portafolionombre
    from portafolio_categoria  inner join portafolio
    on portafolio_categoria.portafoliocodigo = portafolio.portafoliocodigo where categoriaportafolionombre like '%s' and categoriaportafolioestado like '%s';",
       $categorianombre.'%' , $Typ);
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
    array("codigo"=>"ADM","valor"=>"Administrador"),
    array("codigo"=>"USR","valor"=>"Usuario"),
    array("codigo"=>"CNS","valor"=>"Consultor"),
    array("codigo"=>"CLT","valor"=>"Cliente")
  );
}

function getEstadoProgramas(){
  return array(
    array("codigo"=>"PND","valor"=>"Sin Activar"),
    array("codigo"=>"ACT","valor"=>"Activo"),
    array("codigo"=>"SPD","valor"=>"Suspendido"),
    array("codigo"=>"INA","valor"=>"Inactivo")
  );
}

 ?>
