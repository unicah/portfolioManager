<?php
require_once("libs/dao.php");


function obtenerdepartamentosporfiltros($departmanetodesc){
  $departamento = array();
  $sqlstr=sprintf("SELECT `departamentocodigo`, `departmanetodesc`, `departamentoest` FROM departamento where departmanetodesc like'%s';",$departmanetodesc.'%');
    $departamento = obtenerRegistros($sqlstr);
    return $departamento;
}

function obtenerdepartamentosActivos(){
  $departamentos = array();
  $sqlstr="SELECT `departamentocodigo`, `departmanetodesc`, `departamentoest` FROM departamento where departamentoest='ACT';";
    $departamentos = obtenerRegistros($sqlstr);
    return $departamentos;
}


function obtenerDepartamentoPorCodigo($depcod){
      $departamento = array();
      $sqlstr = sprintf("SELECT `departamentocodigo`, `departmanetodesc`, `departamentoest`
        FROM departamento where departamentocodigo = '%d';", $depcod);
      $departamento = obtenerUnRegistro($sqlstr);
      return $departamento;
  }
function getEstadodepartamento(){
    return array(
      array("codigo"=>"PND","valor"=>"Sin Activar"),
      array("codigo"=>"ACT","valor"=>"Activo"),
      array("codigo"=>"INA","valor"=>"Inactivo")
    );
  }

function insertardepartamento($departmanetodesc,$departamentoest){
  $strsql = "INSERT INTO `departamento`( `departmanetodesc` ,
   `departamentoest`) VALUES ('%s', '%s');";
  $strsql = sprintf($strsql, $departmanetodesc,$departamentoest);

  if(ejecutarNonQuery($strsql)){
      return getLastInserId();
  }
  return 0;
}




 ?>
