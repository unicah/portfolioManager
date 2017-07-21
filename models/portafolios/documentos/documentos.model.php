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
  function updateDocumentosPortfolio(){
    $sqlstr = "UPDATE `portafolio_documento`
    SET documentoportafolioflujoactual = %d,documentoportafolioobservacion='%s', documentofechamodificado='%s',documentoversionactual='%s',documentoeditoractual=%d,
       documentofichero='%s', documentousuariomodifica=%d, documentoultimaversion=%d,
       documentourl='%s' WHERE `documentoportafolio`=%d;";
       $sqlstr = sprintf();
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




  function obtenerversionPorCodigo($portafoliocodigo){
      $portafolio = array();
      $sqlstr = sprintf("SELECT * FROM portafolio_documento_version where `documentoportafolio` = %d;",$portafoliocodigo);
      $portafolio = obtenerUnRegistro($sqlstr);
      return $portafolio;
  }

  function obtenerVersionesPortafolio($codigoPortafolio){
   $versiones = array();
   $sqlstr = "select documentoversion, versionobservacion, versionurl from portafolio_documento_version
                     where documentoportafolio = %d;";
   $versiones = obtenerRegistros(sprintf($sqlstr,$codigoPortafolio));
   return $versiones;
  }



function obtenerFlujoNombre($cod, $portcod){
  $docuFlujo = Array();
  $sqlstr = "SELECT a.documentodescripcion, b.flujoportafolionombre, a.documentoportafolioobservacion
FROM portafolio_documento a inner join portafolio_flujo b on a.documentoportafolioflujoactual = b.flujoportafolio
where a.documentoportafolio=%d and b.portafoliocodigo=%d;";

  $docuFlujo = obtenerUnRegitro(sprintf($sqlstr,$cod, $portcod));
  return $docuFlujo;
}

function obtenerDocumento($cod){
  $docu = array();
  $sqlstr = "SELECT documentodescripcion, documentoportafoliocodigo as documentoportafoliocodigo2, documentoportafolioflujoactual FROM portafolio_documento
  WHERE documentoportafolio = %d;";
  $docu = obtenerunRegistro(sprintf($sqlstr,$cod));
  return $docu;
}
?>
