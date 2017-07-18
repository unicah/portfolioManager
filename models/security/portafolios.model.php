<?php
   require_once("libs/dao.php");

   function obtenerPortafolioPorNombre($portafolioNombre){
       $portafolio = array();
       $sqlstr = sprintf("SELECT `portafoliocodigo`,`portafolionombre`,
       UNIX_TIMESTAMP(`portafoliofechacreado`) as portafoliofechacreado, `portafolioobservacion`, `portafolioestado`,
       `departamentocodigo`
          FROM portafolio where portafolionombre = '%s';",$portafolionombre);
       $portafolio = obtenerUnRegistro($sqlstr);
       return $portafolio;
   }

   function obtenerUsuarioPorFiltro($portafolionombre, $userType){
       $portafolio = array();
       $sqlstr = sprintf("SELECT `portafoliocodigo`,`portafolionombre`, `portafolioobservacion`,
       `portafolioestado`
          FROM portafolio where portafolionombre like '%s' and portafolioestado like '%s';",
          $portafolionombre.'%' , $userType);
       $portafolio = obtenerRegistros($sqlstr);
       return $portafolio;
   }

/*   function obtenerUsuariosPorTipo($userType, $userEst='ACT', $userName ='%'){
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
*/
   function obtenerPortafolioPorCodigo($portafoliocodigo){
       $portafolio = array();
       $sqlstr = sprintf("SELECT `portafoliocodigo`,`portafolionombre`,
       UNIX_TIMESTAMP(`portafoliofechacreado`) as portafoliofechacreado, `portafolioobservacion`, `portafolioestado`,
       `departamentocodigo`
          FROM portafolio where portafoliocodigo = %d;",$portafoliocodigo);
       $portafolio = obtenerUnRegistro($sqlstr);
       return $portafolio;
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



   ?>
