<?php
//middleware de verificación

    function mw_estaLogueado(){
        if( isset($_SESSION["userLogged"]) && $_SESSION["userLogged"] == true){
          return true;
        }else{
          $_SESSION["userLogged"] = false;
          $_SESSION["userCode"] = "";
          $_SESSION["userScreenName"] = "";
          $_SESSION["userEmail"] = "";
          return false;
        }
    }
    function mw_setEstaLogueado($usuario, $nombre, $email, $logueado){
        if($logueado){
            $_SESSION["userLogged"] = true;
            $_SESSION["userCode"] = $usuario;
            $_SESSION["userEmail"] = $email;
            $_SESSION["userScreenName"] = $nombre;
        }else{
            $_SESSION["userLogged"] = false;
            $_SESSION["userCode"] = "";
            $_SESSION["userScreenName"] = "";
            $_SESSION["userEmail"] = "";
        }
    }
    function mw_redirectToLogin($to){
        $loginstring = urlencode("?".$to);
        $url = "index.php?page=login&returnUrl=".$loginstring;
        header("Location:" . $url);
        die();
    }

?>
