<?php
    //phpinfo();
    $conn = new mysqli("localhost","root","root","portfoliomanager");

    if($conn->errno){
     die($conn->error);
     //die();
   }/*

    $queryStr = "select * from usuario;";

    $resultado = $conn->query($queryStr);

    $usuarios = array();
    foreach($resultado as $registro){
      $usuarios[] = $registro;
    }*/
    //$rolescod = "test1";
    $queryStr = "SELECT rolescod, rolesdsc, rolesest FROM roles WHERE rolescod = 'pr1';";
    $resultado = $conn->query($queryStr);
    $roles = array();
    foreach($resultado as $registro){
      $roles[] = $registro;
    }

    print_r($roles);

?>
