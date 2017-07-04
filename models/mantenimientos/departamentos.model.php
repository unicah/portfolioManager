<?php
require_once("libs/dao.php");

function obtenerDepartamentosPorFiltro($departamentodesc, $Typ){
    $departamento = array();
    $sqlstr = sprintf("SELECT *FROM departamento where departmanetodesc like '%s' and departamentoest like '%s';",
    $departamentodesc.'%', $Typ);
    $departamento = obtenerRegistros($sqlstr);
    return $departamento;
}

function obtenerDepartamentoPorCodigo($departamentocodigo){
    $departamento = array();
    $sqlstr = sprintf("SELECT *FROM departamento where departamentocodigo = %d;",$departamentocodigo);
    $departamento = obtenerUnRegistro($sqlstr);
    return $departamento;
}

function insertDepartamento($departamentodesc, $departamentoest ){
    $strsql = "INSERT INTO `departamento` (
        `departmanetodesc`,`departamentoest`) VALUES ('%s','%s');";
    $strsql = sprintf($strsql, $departamentodesc, $departamentoest);

    if(ejecutarNonQuery($strsql)){
        return true;
    }
    return 0;
}


function updateDepartamento($departamentocodigo, $departamentodesc, $departamentoest){
    $strsql = "UPDATE `departamento` set
                `departmanetodesc` = '%s', `departamentoest` = '%s'
                where `departamentocodigo` = %d ;";
    $strsql = sprintf($strsql, $departamentodesc, $departamentoest, intval($departamentocodigo));

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

function getEstadoDepartamentos(){
  return array(
    array("codigo"=>"PND","valor"=>"Sin Activar"),
    array("codigo"=>"ACT","valor"=>"Activo"),
    array("codigo"=>"SPD","valor"=>"Suspendido"),
    array("codigo"=>"INA","valor"=>"Inactivo")
  );
}

 ?>
