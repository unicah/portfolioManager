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
        require_once("controllers/mw/support.mw.php");
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
                case "bitacora":
                ($logged)?
                  require_once("controllers/support/bitacora.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                die();
                case "portafolio":
                ($logged)?
                  require_once("controllers/portafolios/portafolios.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                die();
                case "portafolios":
                ($logged)?
                  require_once("controllers/portafolios/portafolio.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                die();
        }
    // Elimina el menu administrativo
    require_once("controllers/error.control.php");
?>
