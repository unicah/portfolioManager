<?php
  require_once('libs/dao.php');

  function obtenerDocumentosDelPortafolio($portfolioCod, $nombreFiltro){
    $documentos = Array();

    $sqlstr = "select a.documentoportafolio, a.documentoportafoliocodigo,
            a.documentoportafolioflujoactual, c.flujoportafolionombre,
            a.categoriaportafolio, b.categoriaportafolionombre,  a.documentoversionactual, a.documentodescripcion,
             a.documentofichero, a.documentousuarioingresa, a.documentousuariomodifica,
             a.documentoultimocomentario, a.documentoultimalarma, a.documentoultimaversion, a.documentourl
    from portafolio_documento a inner join portafolio_categoria b on a.portafoliocodigo = b.portafoliocodigo
    and a.categoriaportafolio = b.categoriaportafolio
    inner join portafolio_flujo c on
      a.portafoliocodigo = c.portafoliocodigo and a.documentoportafolioflujoactual = c.flujoportafolio
    where a.portafoliocodigo = %d;";

    $documentos = obtenerRegistros(sprintf($sqlstr, $portfolioCod));

    return $documentos;
  }

  function insertarNuevoDocumentoPortafolio( $codPortafolio, $documentoportafoliocodigo ,
  $documentodescripcion, $documentoportafolioobservacion, $categoriaportafolio,
  $documentoportafolioflujoactual, $tfil, $fname){

    $insertSQL = "INSERT INTO `portafolio_documento` (`portafoliocodigo`, `documentoportafoliocodigo`,
      `documentoportafolioflujoactual`, `documentoportafolioestado`, `documentoportafolioobservacion`,
      `categoriaportafolio`, `documentofechamodificado`, `documentoversionactual`,
      `documentoeditoractual`, `documentodescripcion`, `documentofichero`, `documentoextencion`,
       `documentousuarioingresa`, `documentousuariomodifica`, `documentoultimocomentario`,
       `documentoultimalarma`, `documentoultimaversion`,`documentourl`)
      VALUES ( %d, '%s',
        '%s', 'ACT', '%s',
        '%s', now(), 1,
        NULL, '%s', '%s', '',
        %d, NULL, 0,
        0, 1, '%s');";
    $afectado = ejecutarNonQuery(sprintf($insertSQL,
                  $codPortafolio,$documentoportafoliocodigo,
                  $documentoportafolioflujoactual, $documentoportafolioobservacion,
                  $categoriaportafolio,
                  $documentodescripcion, $fname,
                  $_SESSION["userCode"],
                  $tfil
              ));


    $newDocId = getLastInserId();
    return $newDocId;
  }



/*

  function obtenerDocumentoPorCodigo($portcod){
    $doctc =array();
    $sqlstr = sprintf("SELECT `documentodescripcion`
    FROM `portafolio_documento` WHERE `documentoportafoliocodigo` = '%s'; ", $portcod,'%' );
    $doctc = obtenerRegistros($sqlstr);
    return $doctc;

  }*/
?>
