<?php
   require_once("libs/dao.php");

   function obtenerUsuarioPorEmail($userEmail){
       $usuario = array();
       $sqlstr = sprintf("SELECT `usuariocod`,`usuarioemail`, `usuarionom`, `usuariopswd`,
       UNIX_TIMESTAMP(`usuariofching`) as usuariofching, `usuariopswdest`, `usuariopswdexp`,
       `usuarioest`, `usuarioactcod`, `usuariopswdchg`,
       `usuariotipo`
          FROM usuario where usuarioemail = '%s';",$userEmail);
       $usuario = obtenerUnRegistro($sqlstr);
       return $usuario;
   }

   function obtenerUsuarioPorFiltro($userEmail, $userType){
       $usuario = array();
       $sqlstr = sprintf("SELECT `usuariocod`,`usuarioemail`, `usuarionom`,
       `usuarioest`, `usuariotipo`
          FROM usuario where usuarioemail like '%s' and usuariotipo like '%s';",
          $userEmail.'%' , $userType);
       $usuarios = obtenerRegistros($sqlstr);
       return $usuarios;
   }

   function obtenerUsuariosPorTipo($userType, $userEst='ACT', $userName ='%'){
     $usuario = array();
     $sqlstr = sprintf("SELECT `usuariocod`,`usuarioemail`, `usuarionom`, `usuariopswd`,
     UNIX_TIMESTAMP(`usuariofching`) as usuariofching, `usuariopswdest`, `usuariopswdexp`,
     `usuarioest`, `usuarioactcod`, `usuariopswdchg`,
     `usuariotipo`
        FROM usuario where usuariotipo = '%s' and usuarioest='%s' and usuarionom like '%s';",
          $userName,$userEst,$userName.'%');

     $usuario = obtenerRegistros($sqlstr);
     return $usuario;
   }

   function obtenerUsuarioPorCodigo($usuariocod){
       $usuario = array();
       $sqlstr = sprintf("SELECT `usuariocod`,`usuarioemail`, `usuarionom`,`usuariopswd`,
         UNIX_TIMESTAMP(`usuariofching`) as usuariofching,
       `usuarioest`, `usuariotipo`
          FROM usuario where usuariocod = %d;",$usuariocod);
       $usuario = obtenerUnRegistro($sqlstr);
       return $usuario;
   }

   function insertUsuario($userName, $userEmail,
                          $timestamp, $password, $userType = 'SYS', $userEst = 'ACT'){

      //userType= 'SYS' usuario normal, 'CNS' Consultor , 'CLT' Cliente, 'ADM' administrador del sitio
      //-----------------------------------------------------------------


       $strsql = "INSERT INTO `usuario` (
           `usuarioemail`, `usuarionom`, `usuariopswd`,
           `usuariofching`, `usuariopswdest`, `usuariopswdexp`,
           `usuarioest`, `usuarioactcod`, `usuariopswdchg`,
           `usuariotipo`) VALUES ('%s', '%s','%s',
            FROM_UNIXTIME(%s), 'VGT', NULL,
            '%s', '', NULL, '%s');";
       $strsql = sprintf($strsql, valstr($userEmail),
                                   valstr($userName),
                                   $password,
                                   $timestamp,
                                   $userEst,
                                   $userType);

       if(ejecutarNonQuery($strsql)){
           return getLastInserId();
       }
       return 0;
   }

   function updateUsuario($usercod, $userName, $userEmail,
                          $password, $userType, $userEst ){

      //userType= 'SYS' usuario normal, 'CNS' Consultor , 'CLT' Cliente, 'ADM' administrador del sitio
      //-----------------------------------------------------------------


       $strsql = "UPDATE `usuario` set
           `usuarioemail` = '%s', `usuarionom` = '%s', `usuariopswd` = '%s',
           `usuarioest` = '%s',
           `usuariotipo` = '%s' where `usuariocod` = %d;";
       $strsql = sprintf($strsql, valstr($userEmail),
                                   valstr($userName),
                                   $password,
                                   $userEst,
                                   $userType, $usercod);

       $affected = ejecutarNonQuery($strsql);
       return ($affected > 0);
   }
   //funciones adiciones para datos
   function getTiposUsuario(){
     return array(
       array("codigo"=>"ADM","valor"=>"Administrador"),
       array("codigo"=>"USR","valor"=>"Usuario"),
       array("codigo"=>"CNS","valor"=>"Consultor"),
       array("codigo"=>"CLT","valor"=>"Cliente")
     );
   }

   function getEstadoUsuario(){
     return array(
       array("codigo"=>"PND","valor"=>"Sin Activar"),
       array("codigo"=>"ACT","valor"=>"Activo"),
       array("codigo"=>"SPD","valor"=>"Suspendido"),
       array("codigo"=>"INA","valor"=>"Inactivo")
     );
   }

   function obtenerRolesDisponibles($usercod){
      $sqlstr = "select b.rolescod, b.rolesdsc, a.usuariocod
from roles b left join roles_usuarios a
on a.rolescod = b.rolescod and a.usuariocod=%d
where a.usuariocod is null ;";
      $roles = obtenerRegistros(sprintf($sqlstr, $usercod));
      return $roles;
   }
   function obtenerRolesUsuario($usercod){
      $sqlstr = "select b.rolescod, b.rolesdsc, a.usuariocod
from roles b inner join roles_usuarios a
on a.rolescod = b.rolescod
where a.usuariocod = %d ;";
      $roles = obtenerRegistros(sprintf($sqlstr, $usercod));
      return $roles;
   }
   function agregarRolaUsuario($rolcod,$usercod){
     $sqlstr = "INSERT INTO `roles_usuarios` (`usuariocod`, `rolescod`)
                VALUES (%d, '%s' );";
      return ejecutarNonQuery(sprintf($sqlstr, $usercod, $rolcod));
   }
   function eliminarRolaUsuario($rolcod,$usercod){
      $sqlstr = "Delete from`roles_usuarios` where  `usuariocod`= %d and `rolescod` = '%s';";
      return ejecutarNonQuery(sprintf($sqlstr, $usercod, $rolcod));
   }

   function getEstadoCategoria(){
     return array(
       array("codigo"=>"ACT","valor"=>"Activo"),
       array("codigo"=>"INA","valor"=>"Inactivo")
     );
   }

   function insertarColaborador($portafolioid, $iduser, $rol){
     $sqlstr = "INSERT INTO `portafolio_colaboradores` (`portafoliocodigo`, `usuariocod`, `rolportafolio`,
       `colaboradorestado`, `colaboradorfechaexpira`)
       VALUES (%d, %d, '%s', 'ACT', '%s1231');";

     $sqlstr = (sprintf($sqlstr , $portafolioid, $iduser, $rol, intval(date('Y'))+5));

     if(ejecutarNonQuery($sqlstr)){
         return getLastInserId();
     }
     return 0;


   }

   function obtenerUsuarioNotAdded($codport){
       $usuario = array();
       $sqlstr = sprintf("select  a.usuariocod,a.usuarioemail, a.usuarionom, a.usuarioest,
       a.usuariotipo from usuario as a where usuariocod not in
       (select usuariocod from portafolio_colaboradores where portafoliocodigo = %d)", $codport);
       $usuarios = obtenerRegistros($sqlstr);
       return $usuarios;
   }

   function obtenerXCodorol($usuariocod, $rolport){
       $usuario = array();
       $sqlstr = sprintf("SELECT `portafoliocodigo`, `usuariocod`, `rolportafolio` FROM portafolio_colaboradores
         where usuariocod like '%s' and rolportafolio like '%s';",
         $usuariocod.'%' , $rolport.'%');
         $usuarios = obtenerRegistros($sqlstr);
         return $usuarios;
   }

   function updateColaboradores($portafoliocod, $colaboradorcod, $rolport, $rolest, $rolfecha){
         $strsql = "UPDATE `portafolio_colaboradores`
         SET `portafoliocodigo`='%d', `rolportafolio`='%s', `colaboradorestado`='%s', `colaboradorfechaexpira`='%s'
         WHERE `usuariocod`= %d;";

         $strsql = sprintf($strsql, $portafoliocod, $rolport, $rolest, $rolfecha, $colaboradorcod);
         $affected = ejecutarNonQuery($strsql);
         return ($affected > 0);

       }



   ?>
