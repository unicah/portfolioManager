<?php

    session_start();

    require_once("libs/utilities.php");

    $pageRequest = "home";

    if(isset($_GET["page"])){
        $pageRequest = $_GET["page"];
    }

    //Incorporando los midlewares son codigos que se deben ejecutar
    //Siempre
    require_once("controllers/mw/verificar.mw.php");
    require_once("controllers/mw/site.mw.php");


    //Este switch se encarga de todo el enrutamiento público
    switch($pageRequest){
        //Accesos Publicos
        case "home":
            //llamar al controlador
            require_once("controllers/home.control.php");
            die();
        case "login":
            require_once("controllers/security/login.control.php");
            die();
          case "test":
              require_once("controllers/tests/test.control.php");
              die();
        case "logout":
            require_once("controllers/security/logout.control.php");
            die();
    }

    //Este switch se encarga de todo el enrutamiento que ocupa login
        $logged = mw_estaLogueado();
        if($logged)addToContext("layoutFile","verified_layout");
        switch($pageRequest){
            case "admin":
              ($logged)?
                  require_once("controllers/admin/admin.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
            case "users":
              ($logged)?
                require_once("controllers/security/users.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
            case "user":
              ($logged)?
                require_once("controllers/security/user.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
<<<<<<< Updated upstream
              case "programas":
                ($logged)?
                  require_once("controllers/mantenimientos/programas.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                die();
=======
            case "user":
              ($logged)?
                require_once("controllers/mantenimientos/programas.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
>>>>>>> Stashed changes
        }
    // Elimina el menu administrativo


    require_once("controllers/error.control.php");
?>
