<?php

    function renderizar($vista, $datos, $layoutFile = "layout.view.tpl"){
        if(!is_array($datos)){
            http_response_code(404);
            die("Error de renderizador: datos no es un arreglo");
        }

        //union de los dos arreglos
        global $global_context;
        $datos = array_merge($global_context, $datos);
        //union de variables de sessión
        $datos = array_merge($_SESSION, $datos);
        if(isset($datos["layoutFile"])){
          $layoutFile = $datos["layoutFile"];
        }
        if(strpos($layoutFile,".view.tpl")===false){
          $layoutFile .= ".view.tpl";
        }

        $viewsPath = "views/";
        $fileTemplate = $vista.".view.tpl";
        $htmlContent = "";
        if(file_exists($viewsPath.$layoutFile)){
            $htmlContent = file_get_contents($viewsPath.$layoutFile);
            if(file_exists($viewsPath.$fileTemplate)){
                $tmphtml = file_get_contents($viewsPath.$fileTemplate);
                $htmlContent = str_replace("{{{page_content}}}",
                            $tmphtml,
                            $htmlContent);
                //Limpiar Saltos de Pagina
                if (strpos($htmlContent,"<pre>")){

                }else{
                    $htmlContent = str_replace("\n","",$htmlContent);
                    $htmlContent = str_replace("\r","",$htmlContent);
                    $htmlContent = str_replace("\t","",$htmlContent);
                    $htmlContent = str_replace("  ","",$htmlContent);
                }
                //obtiene un arreglo separando lo distintos tipos de nodos
                $template_code = parseTemplate($htmlContent);
                $htmlResult = renderTemplate($template_code, $datos);

                echo $htmlResult;

            }
        }
    }

    function renderTemplate($template_block, $context){
        $renderedHTML = "";
        $foreachIsOpen = false;
        $ifIsOpen = false;
        $ifCondition = false;
        $ifNotIsOpen = false;
        $ifNotCondition = false;
        $innerBlock = array();
        $currentContext = "";

        foreach($template_block as $node){
            //buscando si es un cierre de foreach
            if(strpos($node,"{{endfor $currentContext}}") !== false){
                if ($foreachIsOpen){
                    $foreachIsOpen = false;
                    if(isset($context[$currentContext] )){
                        foreach($context[$currentContext] as $forcontext) {
                            $renderedHTML .= renderTemplate($innerBlock, $forcontext);
                        }
                    }
                    $innerBlock = array();
                    $currentContext = "";
                    continue;
                }
            }


            //buscando si es un cierre de if
            if(strpos($node,"{{endifnot $currentContext}}") !== false){
                if ($ifNotIsOpen){
                    $ifNotIsOpen = false;
                    $renderedHTML .= ($ifNotCondition)?renderTemplate($innerBlock, $context):"";
                    $currentContext = "";
                    $innerBlock = array();
                    $ifNotCondition = false;
                    continue;
                }
            }

            if(strpos($node,"{{endif $currentContext}}") !== false){
                if ($ifIsOpen){
                    $ifIsOpen = false;
                    $renderedHTML .= ($ifCondition)?renderTemplate($innerBlock, $context):"";
                    $currentContext = "";
                    $innerBlock = array();
                    $ifCondition =false;
                    continue;
                }
            }

            if($foreachIsOpen || $ifIsOpen || $ifNotIsOpen){
                $innerBlock[] = $node;
                continue;
            }

            //buscando si es una apertura de foreach
            if(strpos($node,"{{foreach") !== false){
                if(!$foreachIsOpen){
                    $foreachIsOpen = true;
                    $currentContext = trim(str_replace("}}","",str_replace("{{foreach","",$node)));
                    continue;
                }
            }
            //buscando si es un if
            if(strpos($node,"{{ifnot")  !== false){
                if(!$ifNotIsOpen){
                    $ifNotIsOpen = true;
                    $currentContext = trim(str_replace("}}","",str_replace("{{ifnot","",$node)));
                    if(isset($context[$currentContext])){
                        $ifNotCondition = ($context[$currentContext]) == false;
                    }
                    continue;
                }
            }

            if(strpos($node,"{{if")  !== false){
                if(!$ifIsOpen){
                    $ifIsOpen = true;
                    $currentContext = trim(str_replace("}}","",str_replace("{{if","",$node)));
                    if(isset($context[$currentContext])){
                        $ifCondition = ($context[$currentContext]) && true;
                    }
                    continue;
                }
            }

            //remplazando las variables del nodo
            $nodeReplace = preg_split("/(\{\{\w*\}\})/",$node,-1,PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );
            foreach($nodeReplace as $item){
                if(strpos($item,"{{")  !== false){
                    $index = trim(str_replace("}}","",str_replace("{{","",$item)));
                    if($index === "this" && !(is_array($context))){
                      $item = $context;
                    }else{
                      $item = isset($context[$index])?$context[$index]:"";
                    }
                }
                $renderedHTML .= $item;
            }
        }
        return $renderedHTML;
    }

    function parseTemplate($htmlTemplate){

        $regexp_array = array( 'foreach'   => '(\{\{foreach \w*\}\})',
                               'endfor'    => '(\{\{endfor \w*\}\})',
                               'if'        => '(\{\{if \w*\}\})',
                               'if_not'    =>'(\{\{ifnot \w*\}\})',
                               'if_close'  => '(\{\{endif \w*\}\})',
                               'ifnot_close'  => '(\{\{endifnot \w*\}\})');

        $tag_regexp = "/" . join( "|", $regexp_array ) . "/";

        //split the code with the tags regexp
        $template_code = preg_split ( $tag_regexp, $htmlTemplate, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );

        return $template_code;
    }

?>
