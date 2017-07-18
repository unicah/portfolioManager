<?php
   require_once("libs/dao.php");

   function obtenerPortafolioPorNombre($portafolioNombre){
       $portafolio = array();
       $sqlstr = sprintf("SELECT `portafoliocodigo`,`portafolionombre`,
       `portafoliofechacreado`, `portafolioobservacion`, `portafolioestado`,
       `departamentocodigo`
          FROM portafolio where portafolionombre = '%s';",$portafolionombre);
       $portafolio = obtenerUnRegistro($sqlstr);
       return $portafolio;
   }

   function obtenerPortafolioPorFiltro($portafolionombre, $userType){
       $portafolio = array();
       $sqlstr = sprintf("SELECT * FROM portafolio where portafolionombre like '%s' and portafolioestado like '%s';",
          $portafolionombre.'%' , $userType);
       $portafolio = obtenerRegistros($sqlstr);
       return $portafolio;
   }

   function obtenerMisPortafolios($usercod){
     $sqlstr = "select a.portafoliocodigo, a.portafolionombre,
                    		a.portafolioestado, b.departmanetodesc,
                            (Select count(*) from portafolio_colaboradores d
                                      where a.portafoliocodigo = d.portafoliocodigo) as portafolio_colaboradores,
                            (Select count(*) from portafolio_documento e
                                      where a.portafoliocodigo = e.portafoliocodigo) as portafolio_documentos
                    from portafolio a
                    	inner join departamento b on a.departamentocodigo = b.departamentocodigo
                        inner join portafolio_colaboradores c on a.portafoliocodigo = c.portafoliocodigo
                    where c.usuariocod = %d;";
     $portafolios = array();

     $portafolios = obtenerRegistros(sprintf($sqlstr, $usercod));
     return $portafolios;

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
       `portafoliofechacreado`, `portafolioobservacion`, `portafolioestado`,
       `departamentocodigo`
          FROM portafolio where portafoliocodigo = %d;",$portafoliocodigo);
       $portafolio = obtenerUnRegistro($sqlstr);
       return $portafolio;
   }

   function insertPortafolio($nombre,
                          $observacion, $estado, $departamento){

      // El insertado de un portafolio involucra varios inserta para preparar todo un
      // portafolio completo

      iniciarTransaccion();
       $sqlstr = "INSERT INTO `portafolio` (`portafolionombre`, `portafoliofechacreado`,
        `portafolioobservacion`, `portafolioestado`,
        `departamentocodigo`) VALUES ('%s',now(),'%s','%s',%d);";
       $sqlstr = sprintf($sqlstr,  $nombre,
                                   valstr($observacion),
                                   $estado,
                                   $departamento);

       if(ejecutarNonQuery($sqlstr)){
           $portfolioid =  getLastInserId();
           // llenamos ahora todos los roles por defecto
           $sqlstr = "INSERT INTO `portafolio_rol` (`rolportafolio`, `portafoliocodigo`, `rolportafolionombre`,
                    `rolportafolioestado`, `roledicion`, `rolvisualiza`)
                        VALUES ('%s', %d, '%s', 'ACT', '%s', '%s');";

           ejecutarNonQuery(sprintf($sqlstr , 'ADM', $portfolioid, 'Administrador','*SI','*SI'));
           ejecutarNonQuery(sprintf($sqlstr , 'CLT', $portfolioid, 'Cliente','*NO','*SI'));
           ejecutarNonQuery(sprintf($sqlstr , 'CNS', $portfolioid, 'Consultor','*SI','*SI'));
           ejecutarNonQuery(sprintf($sqlstr , 'AUD', $portfolioid, 'Auditor','*NO','*SI'));
           ejecutarNonQuery(sprintf($sqlstr , 'PUB', $portfolioid, 'Publico','*NO','*NO'));

           // lenamos el creador como colaborador administrativo
           $sqlstr = "INSERT INTO `portafolio_colaboradores` (`portafoliocodigo`, `usuariocod`, `rolportafolio`,
             `colaboradorestado`, `colaboradorfechaexpira`)
             VALUES (%d, %d, 'ADM', 'ACT', '%s1231');";

           ejecutarNonQuery(sprintf($sqlstr , $portfolioid, $_SESSION["userCode"],intval(date('Y'))+5));

           // llenamos las categorías predeterminadas
           $sqlstr = "INSERT INTO `portafolio_categoria` (`categoriaportafolio`, `portafoliocodigo`,
                      `categoriaportafolionombre`, `categoriaportafolioestado`)
                      VALUES ('%s', %d, '%s', 'ACT');";

           ejecutarNonQuery(sprintf($sqlstr , 'CTR', $portfolioid, 'Contratos'));
           ejecutarNonQuery(sprintf($sqlstr , 'DEX', $portfolioid, 'Documentos Externos'));
           ejecutarNonQuery(sprintf($sqlstr , 'DIN', $portfolioid, 'Documentos Internos'));
           ejecutarNonQuery(sprintf($sqlstr , 'LEY', $portfolioid, 'Leyes'));
           ejecutarNonQuery(sprintf($sqlstr , 'EST', $portfolioid, 'Estudios'));
           ejecutarNonQuery(sprintf($sqlstr , 'RGL', $portfolioid, 'Reglamentos'));
           ejecutarNonQuery(sprintf($sqlstr , 'MNL', $portfolioid, 'Manuales'));
           ejecutarNonQuery(sprintf($sqlstr , 'FNZ', $portfolioid, 'Facturas, Recibos, Ordenes de Compras'));
           ejecutarNonQuery(sprintf($sqlstr , 'ACT', $portfolioid, 'Actas'));

           //llenamos los flujos predeterminados de los documentos
           $sqlstr = "INSERT INTO `portafolio_flujo` (`flujoportafolio`, `portafoliocodigo`,
                              `flujoportafolionombre`, `flujoportafolioestado`)
                      VALUES ('%s', %d, '%s', 'ACT');";
           ejecutarNonQuery(sprintf($sqlstr , '010', $portfolioid, 'Borrador'));
           ejecutarNonQuery(sprintf($sqlstr , '020', $portfolioid, 'Revisión'));
           ejecutarNonQuery(sprintf($sqlstr , '030', $portfolioid, 'Edición'));
           ejecutarNonQuery(sprintf($sqlstr , '040', $portfolioid, 'Atualizado'));
           ejecutarNonQuery(sprintf($sqlstr , '050', $portfolioid, 'Aprobado'));
           ejecutarNonQuery(sprintf($sqlstr , '060', $portfolioid, 'Sellado'));
           ejecutarNonQuery(sprintf($sqlstr , '070', $portfolioid, 'Entregado'));

           terminarTransaccion(true); //se hace un commit de todos los movimientos
           return $portfolioid;
       }
       terminarTransaccion(false); // se hace un rolback
       return 0;
   }

   function updatePortafolio($usercod, $userName, $userEmail,
                          $password, $userType, $userEst ){

      //userType= 'SYS' usuario normal, 'CNS' Consultor , 'CLT' Cliente, 'ADM' administrador del sitio
      //-----------------------------------------------------------------


      //  $strsql = "UPDATE `usuario` set
      //      `usuarioemail` = '%s', `usuarionom` = '%s', `usuariopswd` = '%s',
      //      `usuarioest` = '%s',
      //      `usuariotipo` = '%s' where `usuariocod` = %d;";
      //  $strsql = sprintf($strsql, valstr($userEmail),
      //                              valstr($userName),
      //                              $password,
      //                              $userEst,
      //                              $userType, $usercod);
       //
      //  $affected = ejecutarNonQuery($strsql);
      // return ($affected > 0);
      return false;
   }


   function obtenerColaboradoresDelPortafolio($codigoPortafolio){
     $colaboradores = array();

     $sqlstr = "select b.usuarionom, b.usuariocod, a.rolportafolio
	from portafolio_colaboradores a
		inner join usuario b on a.usuariocod = b.usuariocod
	where a.colaboradorestado = 'ACT' and b.usuarioest = 'ACT'
    and a.portafoliocodigo = %d;";

    $colaboradores = obtenerRegistros(sprintf($sqlstr,$codigoPortafolio));
     return $colaboradores;
   }

   function obtenerCategoriasPortafolio($codigoPortafolio){
     $categorias = array();

     $sqlstr = "select a.categoriaportafolio, a.categoriaportafolionombre from portafolio_categoria a
                    where a.categoriaportafolioestado='ACT' and a.portafoliocodigo = %d;";

    $categorias = obtenerRegistros(sprintf($sqlstr,$codigoPortafolio));
     return $categorias;
   }

   function obtenerFlujosPortafolio($codigoPortafolio){
    $flujos = array();
    $sqlstr = "select flujoportafolio, flujoportafolionombre from portafolio_flujo
                      where flujoportafolioestado='ACT' and portafoliocodigo = %d;";
    $flujos = obtenerRegistros(sprintf($sqlstr,$codigoPortafolio));
    return $flujos;
   }

   function getEstadoPortafolio(){
     return array(
       array("codigo"=>"PND","valor"=>"Propuesta"),
       array("codigo"=>"ACT","valor"=>"Activo"),
       array("codigo"=>"CRR","valor"=>"Cerrado"),
       array("codigo"=>"SPS","valor"=>"Suspendido"),
       array("codigo"=>"CNL","valor"=>"Cancelado")
     );
   }

   function obtenerRolesPortafolio($codigoPortafolio){
    $roles = array();
    $sqlstr = "select `rolportafolio`, `portafoliocodigo`, `rolportafolionombre`,
             `rolportafolioestado`, `roledicion`, `rolvisualiza`
              from portafolio_rol
              where rolportafolioestado='ACT' and portafoliocodigo = %d;";
    $roles = obtenerRegistros(sprintf($sqlstr,$codigoPortafolio));
    return $roles;
   }


   ?>
