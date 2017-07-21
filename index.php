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
            case "mnt":
              ($logged)?
                  require_once("controllers/mantenimientos/mntmenu.control.php"):
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
            case "programas":
              ($logged)?
                require_once("controllers/mantenimientos/programas.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
            case "programa":
                ($logged)?
                  require_once("controllers/mantenimientos/programa.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                die();
            case "departamentos":
              ($logged)?
                require_once("controllers/mantenimientos/departamentos.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
            case "departamento":
              ($logged)?
                require_once("controllers/mantenimientos/departamento.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
            case "bitacora":
                ($logged)?
                  require_once("controllers/support/bitacora.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                die();
            case "roles":
              ($logged)?
                require_once("controllers/mantenimientos/roles.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
            case "rol":
              ($logged)?
                require_once("controllers/mantenimientos/rol.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
           case "portafolios":
              ($logged)?
                require_once("controllers/portafolios/portafolios.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
           case "portafolio":
              ($logged)?
                require_once("controllers/portafolios/portafolio.control.php"):
                mw_redirectToLogin($_SERVER["QUERY_STRING"]);
              die();
           case "portafolioww":
                 ($logged)?
                   require_once("controllers/portafolios/portafolioww.control.php"):
                   mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                 die();

           case "docupload":
                 ($logged)?
                   require_once("controllers/portafolios/documentos/docupload.control.php"):
                   mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                 die();
          case 'docuview':
                 ($logged)?
                  require_once("controllers/portafolios/documentos/docuview.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                die();
          case "colaboradores":
                 ($logged)?
                   require_once("controllers/portafolios/colaboradores.control.php"):
                   mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                 die();
         case "colaboradoresD":
                ($logged)?
                  require_once("controllers/portafolios/colaboradoresD.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                die();

          case "editarflujos":
                  ($logged)?
                  require_once("controllers/portafolios/editarflujos.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                  die();

          case "categoria":
                 ($logged)?
                   require_once("controllers/portafolios/categoria.control.php"):
                   mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                 die();

          case "colaboradoreditar":
                ($logged)?
                  require_once("controllers/portafolios/colaboradoreditar.control.php"):
                  mw_redirectToLogin($_SERVER["QUERY_STRING"]);
                die();

        }

    // Elimina el menu administrativo


    require_once("controllers/error.control.php");
?>
