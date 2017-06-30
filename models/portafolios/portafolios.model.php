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

   function obtenerPortafolioPorFiltro($portafolionombre, $userType){
       $portafolio = array();
       $sqlstr = sprintf("SELECT *FROM portafolio where portafolionombre like '%s' and portafolioestado like '%s';",
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

   function insertPortafolio($nombre, $fecha,
                          $observacion, $estado, $departamento){

                            /*

INSERT INTO `portafolio` (`portafolionombre`, `portafoliofechacreado`,
 `portafolioobservacion`, `portafolioestado`,
 `departamentocodigo`) VALUES ('%s', FROM_UNIXTIME(%s),'%s','%s','%s');

                            */
       $strsql = "INSERT INTO `portafolio` (`portafolionombre`, `portafoliofechacreado`,
        `portafolioobservacion`, `portafolioestado`,
        `departamentocodigo`) VALUES ('%s', FROM_UNIXTIME(%s),'%s','%s','%s');";
       $strsql = sprintf($strsql,  $nombre,
                                   $fecha,
                                   $observacion,
                                   $estado,
                                   $departamento);

       if(ejecutarNonQuery($strsql)){
           return getLastInserId();
       }
       return 0;
   }

   function updatePortafolio($usercod, $userName, $userEmail,
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
   function getDepartamento(){
     return array(
       array("codigo"=>"1","valor"=>"Administrador"),
       array("codigo"=>"2","valor"=>"Usuario"),
       array("codigo"=>"3","valor"=>"Consultor"),
       array("codigo"=>"4","valor"=>"Cliente")
     );
   }

   function getEstadoPortafolio(){
     return array(
       array("codigo"=>"PND","valor"=>"Sin Activar"),
       array("codigo"=>"ACT","valor"=>"Activo"),
       array("codigo"=>"SPD","valor"=>"Suspendido"),
       array("codigo"=>"INA","valor"=>"Inactivo")
     );
   }



   ?>
