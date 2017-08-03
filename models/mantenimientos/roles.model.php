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
    function obtenerRolesPorCodigo($rolescod){
        $roles = array();
        $sqlstr = sprintf("SELECT rolescod, rolesdsc, rolesest FROM roles WHERE rolescod = '%s'",$rolescod);
        $roles = obtenerUnRegistro($sqlstr);
        return $roles;
    }
    function insertRol($rolescod,$rolesdsc, $rolesest){
        $strsql = "INSERT INTO `roles` (`rolescod`, `rolesdsc`, `rolesest`) VALUES ('%s','%s', '%s');";
        $strsql = sprintf($strsql,valstr($rolescod) , $rolesdsc, $rolesest);

        if(ejecutarNonQuery($strsql)){
            return true;
        }
        return 0;
    }

    function insertRol2($rolescod, $rolesdsc, $rolesest ){

      $strsql = " INSERT INTO `roles` (`rolescod`, `rolesdsc`, `rolesest`) VALUES ('%s', '%s', '%s');";

      $strsql = sprintf($strsql, valstr($rolescod), ($rolesdsc),  $rolesest);
        if(ejecutarNonQuery($strsql)){
          return true;
        }
        return 0;
    }

    function updateRoles($rolescod, $rolesdsc, $rolesest){
      $strsql = "UPDATE `roles` SET `rolesdsc`='%s', `rolesest`='%s' WHERE `rolescod`='%s';";
        $strsql = sprintf($strsql,  $rolesdsc,   $rolesest, valstr($rolescod));
      $affected = ejecutarNonQuery($strsql);
      return ($affected > 0);
    }

    function agregarProgramaARol($pgmcod,$rolcod){
      $sqlstr = "INSERT INTO `programa_roles` (`programacod`, `rolescod`)
                 VALUES ('%s', '%s' );";
        return ejecutarNonQuery(sprintf($sqlstr, $pgmcod, $rolcod));
    }

    function eliminarProgramaARol($pgmcod,$rolcod){
      $sqlstr = "Delete from`programa_roles` where  `programacod`= '%s' and `rolescod` = '%s';";
      return ejecutarNonQuery(sprintf($sqlstr, $pgmcod, $rolcod));

    }

    function obtenerProgramasDisponibles($rolcod){
      $sqlstr = "select b.programacod, b.programadsc, a.rolescod
from programas b left join programa_roles a
on a.programacod = b.programacod and a.rolescod='%s'
where a.programacod is null ;";
      $pgms = obtenerRegistros(sprintf($sqlstr, $rolcod));
      return $pgms;
    }
    function obtenerProgramasAsignados($rolcod){
      $sqlstr = "select b.programacod, b.programadsc, a.rolescod
from programas b inner join programa_roles a
on a.programacod = b.programacod
where a.rolescod = '%s' ;";
      $pgms = obtenerRegistros(sprintf($sqlstr, $rolcod));
      return $pgms;
    }

 ?>
