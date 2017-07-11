<?php


    require_once("libs/dao.php");

    function obtenerflujos($flujoCodigo){
      $flujo = array();
      $sqlstr = sprintf("SELECT 'portafoliocodigo','flujoportafolionombre','flujoportafolioestado' FROM portafolio_flujo WHERE flujoportafolio = %d;",$rolCodigo);
      $rol = obtenerUnRegistro($sqlstr);
      return $rol;
    }
    function obtenerRolesDsc($rolDsc){
      $rol = array();
      $sqlstr = sprintf("SELECT 'portafoliocodigo','flujoportafolionombre','flujoportafolioestado' FROM roles WHERE rolesdsc = %d;",$rolDsc);
      $rol = obtenerUnRegistro($sqlstr);
      return $rol;
    }

    function obtenerRolesPorFiltro($rolesdsc, $userType){
        $usuario = array();
        $sqlstr = sprintf("SELECT `portafoliocodigo`,`flujoportafolionombre`, `flujoportafolioestado`

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

    }
