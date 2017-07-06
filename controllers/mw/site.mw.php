<?php
//middleware de configuración de todo el sitio

function site_init(){
    addToContext("page_title","Portfolio Manager V0.1");
    date_default_timezone_set ( "America/Tegucigalpa" );
}
site_init();

?>
