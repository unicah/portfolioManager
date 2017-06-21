<?php
    require_once("libs/dao.php");

    function obtenerTodasBitacoras(){
      $sqlstr = "Select * from bitacora;";
      return obtenerRegistros($sqlstr);
    }
    function insertBitacora($fecha = null, $programa = "", $desc = "", $obsr = "", $tipo = 'INF', $usuario = 0){
      $updStr =  "INSERT INTO `bitacora` ( `bitacorafch`, `bitprograma`,
        `bitdescripcion`, `bitobservacion`, `bitTipo`, `bitusuario`)
        VALUES ('%s', '%s',
        '%s', '%s', '%s', %d);";
        $rfch = ($fecha===null)? date("Y-m-d h:i:s") : $fecha;
        $robs = (is_array($obsr))? json_encode($obsr): $obsr;

        $updStr = sprintf($updStr, $rfch,
                                $programa, $desc,
                              $robs, $tipo, $usuario);

        ejecutarNonQuery($updStr);
        return getLastInserId();
    }
 ?>
