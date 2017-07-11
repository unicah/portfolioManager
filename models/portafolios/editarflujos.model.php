<?php


    require_once("libs/dao.php");

    function obtenerflujos($Code){
      $flujo = array();
      $sqlstr = sprintf("SELECT 'portafoliocodigo','flujoportafolionombre','flujoportafolioestado' FROM portafolio_flujo WHERE flujoportafolio = %d;",$Code);
      $flujo = obtenerUnRegistro($sqlstr);
      return $flujo;
    }
    function obtenerflujosDsc($flujosDsc){
      $flujo = array();
      $sqlstr = sprintf("SELECT 'portafoliocodigo','flujoportafolionombre','flujoportafolioestado' FROM portafolio_flujo WHERE flujoportafolionombre = %d;",$flujosDsc);
      $flujo = obtenerUnRegistro($sqlstr);
      return $flujo;
    }

    function obtenerflujosPorFiltro($flujosdsc, $userType){
        $usuario = array();
        $sqlstr = sprintf("SELECT 'portafoliocodigo','flujoportafolionombre', 'flujoportafolioestado'

           FROM portafolio_flujo where flujoportafolio like '%s' and flujoportafolionombre like '%s';", $flujosdsc.'%' , $userType);
        $usuarios = obtenerRegistros($sqlstr);
        return $usuarios;
    }
    function getEstadoflujo(){
      return array(
        array("codigo"=>"ACT","valor"=>"Activo"),
        array("codigo"=>"INA","valor"=>"Inactivo")
      );
    }
    function obtenerflujosPorCodigo($code){
        $flujos = array();
        $sqlstr = sprintf("SELECT *FROM portafolio_flujo WHERE flujoportafolio = '%s'",$code);
        $flujos = obtenerUnRegistro($sqlstr);
        return $flujos;
    }
    function insertflujo($code,$flujosdsc, $flujosest){
        $strsql = "INSERT INTO `portafolio_flujo` (`portafoliocodigo`, `flujoportafolionombre`, `flujoportafolioestado`) VALUES ('%s','%s', '%s');";
        $strsql = sprintf($strsql,valstr($code) , $flujosdsc, $flujosest);

        if(ejecutarNonQuery($strsql)){
            return true;
        }
        return 0;
    }

    /*
INSERT INTO `portfoliomanager`.`portafolio_flujo` (`flujoportafolio`,
`portafoliocodigo`, `flujoportafolionombre`,
 `flujoportafolioestado`) VALUES (NULL, NULL, NULL, NULL);
    */

    function insertflujo2($flujoportafolio, $portafoliocodigo, $flujoportafolionombre, $flujoportafolioestado ){

      $strsql = " INSERT INTO `portfoliomanager`.`portafolio_flujo` (`flujoportafolio`,
      `portafoliocodigo`, `flujoportafolionombre`,
       `flujoportafolioestado`) VALUES ('%s', %d, '%s', '%s');";

      $strsql = sprintf($strsql, valstr($flujoportafolio), intval($portafoliocodigo), ($flujoportafolionombre),  $flujoportafolioestado);
        if(ejecutarNonQuery($strsql)){
          return true;
        }
        return 0;
    }

    function updateflujo($code, $flujosest){
      $strsql = "UPDATE `portafolio_flujo` SET  `flujoportafolioestado`='%s' WHERE `flujoportafolio`='%s';";
        $strsql = sprintf($strsql, $flujosest, valstr($code));
      $affected = ejecutarNonQuery($strsql);
      return ($affected > 0);
    }
