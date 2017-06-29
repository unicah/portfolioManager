<?php
require_once("libs/dao.php");

function obtenerdepartamentosporfiltros($departmanetodesc){
  $departamento = array();
  $sqlstr=sprintf("SELECT `departamentocodigo`, `departmanetodesc`, `departamentoest` FROM departamento where departmanetodesc like'%s';",$departmanetodesc.'%');
    $departamento = obtenerRegistros($sqlstr);
    return $departamento;
}





 ?>
