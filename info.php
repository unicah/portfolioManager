<?php
    //phpinfo();
    $conn = new mysqli("localhost","root","root","portfoliomanager");

    if($conn->errno){
     die($conn->error);
     //die();
    }

    $queryStr = "select * from usuario;";

    $resultado = $conn->query($queryStr);

    $usuarios = array();
    foreach($resultado as $registro){
      $usuarios[] = $registro;
    }

    print_r($usuarios);

?>
