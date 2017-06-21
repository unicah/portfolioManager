<?php

    require_once("libs/dao.php");




    function obtenerRoles($rolCodigo){
      $rol = array();
      $sqlstr = sprintf("SELECT 'rolescod','rolesdsc','rolesest' FROM roles WHERE rolescod = %d;",$rolCodigo);
      $rol = obtenerUnRegistro($sqlstr);
      return $rol;
    }
    function obtenerRolesDsc($rolDsc){
      $rol = array();
      $sqlstr = sprintf("SELECT 'rolescod','rolesdsc','rolesest' FROM roles WHERE rolesdsc = %d;",$rolDsc);
      $rol = obtenerUnRegistro($sqlstr);
      return $rol;
    }

    function obtenerRolesPorFiltro($rolesdsc, $userType){
        $usuario = array();
        $sqlstr = sprintf("SELECT `rolescod`,`rolesdsc`, `rolesest`

           FROM roles where rolescod like '%s' and rolesdsc like '%s';", $rolesdsc.'%' , $userType);
        $usuarios = obtenerRegistros($sqlstr);
        return $usuarios;
    }
    function getEstadoRol(){
      return array(
        array("codigo"=>"PND","valor"=>"Sin Activar"),
        array("codigo"=>"ACT","valor"=>"Activo"),
        array("codigo"=>"INA","valor"=>"Inactivo")
      );
    }

 ?>
