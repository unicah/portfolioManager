<?php
require_once("libs/dao.php");
/*
function selectLastComen($documentoportafolio){
    $ultimoComentario = array();
    $sqlstr = sprintf("SELECT documentoultimocomentario FROM portafolio_documento where documentoportafolio= '%s';",valstr($documentoportafolio));
    $ultimoComentario = obtenerUnRegistro($sqlstr);
    return $ultimoComentario;
}


INSERT INTO `portafolio_documento_comentario` (`portafoliodocumento`,
 `documentocomentariocodigo`, `documentocomentario`, `documentousuarioingresa`,
 `documentocomentariofecha`,
 `documentocomentarioestado`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL);
*/
function insertComent( $documentoportafoliocodigo, $documentocomentario,
                       $usuarioingresa,$documentocomentariofecha,
                       $documentocomentarioestado ){


        iniciarTransaccion();
        $ultimoComentario=array();
        $sqlstr = sprintf("SELECT documentoultimocomentario FROM portafolio_documento where documentoportafolio=%d ;",intval($documentoportafoliocodigo));

        $ultimoComentario = obtenerUnRegistro($sqlstr)["documentoultimocomentario"];
        //die(var_dump($documentoportafoliocodigo));
        $x=intval($ultimoComentario)+1;
        //Hasta aquí ya esta bien

        $strsql = "INSERT INTO `portafolio_documento_comentario` (`portafoliodocumento`,
         `documentocomentariocodigo`, `documentocomentario`, `documentousuarioingresa`,
         `documentocomentariofecha`,
         `documentocomentarioestado`) VALUES (%d, %d, '%s', %d, now(), 'ACT');";
        $strsql = sprintf($strsql, intval($documentoportafoliocodigo), $x,
                          valstr($documentocomentario), intval($usuarioingresa) );

        if(ejecutarNonQuery($strsql)){
          $strsql = "UPDATE `portafolio_documento` set
                      `documentoultimocomentario` = %d
                      where `documentoportafoliocodigo` = '%s';";
          $strsql = sprintf($strsql, intval($x), $documentoportafoliocodigo);

          $affected = ejecutarNonQuery($strsql);
          terminarTransaccion(true);
          return ($affected>0);
        }


        terminarTransaccion(false);
        return 0;
}

 ?>
