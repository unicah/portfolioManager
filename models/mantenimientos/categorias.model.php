<?php
require_once("libs/dao.php");

function obtenerCategoriasPorFiltro($categorianombre, $Typ){
    $programas = array();
    $sqlstr = sprintf("SELECT portafolio_categoria.categoriaportafolio,
    portafolio_categoria.categoriaportafolionombre,
    portafolio_categoria.categoriaportafolioestado,
    portafolio.portafolionombre
    from portafolio_categoria  inner join portafolio
    on portafolio_categoria.portafoliocodigo = portafolio.portafoliocodigo where categoriaportafolionombre like '%s' and categoriaportafolioestado like '%s';",
       $categorianombre.'%' , $Typ);
    $programas = obtenerRegistros($sqlstr);
    return $programas;
}

function obtenerCategoriaPorCodigo($programacod){
    $programa = array();
    $sqlstr = sprintf("SELECT *FROM portafolio_categoria where categoriaportafolio = '%s';",valstr($programacod));
    $programa = obtenerUnRegistro($sqlstr);
    return $programa;
}

function insertPrograma($programacod,$programadsc, $programaest,
                       $programatyp){
    $strsql = "INSERT INTO `programas` (
        `programacod`,`programadsc`, `programaest`, `programatyp`) VALUES ('%s','%s', '%s','%s');";
    $strsql = sprintf($strsql,valstr($programacod) , $programadsc, $programaest, $programatyp);

    if(ejecutarNonQuery($strsql)){
        return true;
    }
    return 0;
}


function updateCategoria($categoriaportafolio,
              $categoriaportafolioestado){

    $strsql = "UPDATE `portafolio_categoria` set
                `categoriaportafolioestado` = '%s'
                where `categoriaportafolio` = '%s';";
    $strsql = sprintf($strsql, $categoriaportafolioestado, $categoriaportafolio);

    $affected = ejecutarNonQuery($strsql);
    return ($affected > 0);
}


function getEstadoCategoria(){
  return array(
    array("codigo"=>"ACT","valor"=>"Activo"),
    array("codigo"=>"INA","valor"=>"Inactivo")
  );
}

 ?>
