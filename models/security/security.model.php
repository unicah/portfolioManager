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

   function insertUsuario($userName, $userEmail,
                          $timestamp, $password, $userType = 'SYS'){

      //userType= 'SYS' usuario normal, 'CNS' Consultor , 'CLT' Cliente, 'ADM' administrador del sitio
      //-----------------------------------------------------------------


       $strsql = "INSERT INTO `usuario` (
           `usuarioemail`, `usuarionom`, `usuariopswd`,
           `usuariofching`, `usuariopswdest`, `usuariopswdexp`,
           `usuarioest`, `usuarioactcod`, `usuariopswdchg`,
           `usuariotipo`) VALUES ('%s', '%s','%s',
            FROM_UNIXTIME(%s), 'VGT', NULL,
            'ACT', '', NULL, '%s');";
       $strsql = sprintf($strsql, valstr($userEmail),
                                   valstr($userName),
                                   $password,
                                   $timestamp,
                                   $userType);

       if(ejecutarNonQuery($strsql)){
           return getLastInserId();
       }
       return 0;
   }
   ?>
