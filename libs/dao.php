<?php
   //data access object
   require_once("libs/parameters.php");

   // ------------------------


   $conexion = new mysqli($server, $user, $pswd ,
                          $database, $port);

   if($conexion->connect_errno){
        //die();
        die($conexion->connect_error);
   }

   $conexion->set_charset("utf8");

   function obtenerRegistros($sqlstr, &$conexion = null){
        if(!$conexion) global $conexion;
        $result = $conexion->query($sqlstr);
        $resultArray = array();
        foreach($result as $registro){
            $resultArray[] = $registro;
        }
        $result->free();
        return $resultArray;
   }


   function obtenerUnRegistro($sqlstr, &$conexion = null){
        if(!$conexion) global $conexion;
        $result = $conexion->query($sqlstr);
        $resultArray = array();
        $resultArray = $result->fetch_assoc();
        $result->free();
        return $resultArray;

   }

   function iniciarTransaccion(&$conexion = null){
     if(!$conexion) global $conexion;
     $conexion->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
   }

   function terminarTransaccion($commit=true,&$conexion = null){
     if(!$conexion) global $conexion;
     if($commit && true){
       $conexion->commit();
     }else{
       $conexion->rollback();
     }
   }

   function ejecutarNonQuery($sqlstr, &$conexion = null){
        if(!$conexion) global $conexion;
        $result = $conexion->query($sqlstr);
        return $conexion->affected_rows;
   }

   function valstr($str, &$conexion = null){
      if(!$conexion) global $conexion;
      return $conexion->escape_string($str);
   }

   function getLastInserId(&$conexion = null){
     if(!$conexion) global $conexion;
     return $conexion->insert_id;
   }
?>
