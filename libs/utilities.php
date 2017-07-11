<?php
    require_once("libs/template_engine.php");

    $global_context = array();
    function addToContext($key,$value){
        global $global_context;
        $global_context[$key] = $value;
    }
    function unsetContext($key){
      global $global_context;
      unset($global_context[$key]);
    }
    function redirectWithMessage($message, $url="index.php"){
      echo "<script>alert('$message'); window.location='$url';</script>";
      die();
    }

    function redirectWithHtmlMessage($message, $url="index.php"){
    $messageArray = array(
        "message" => $message,
        "url" => $url
    );
     renderizar("htmlmessage",$messageArray);
     die();
    }

    function redirectToUrl($url){
      header("Location: $url");
      die();
    }

    function mergeArrayTo(&$origin, &$destiny){
      if(is_array($origin) && is_array($destiny)){
        foreach($origin as $okey => $ovalue){
          if(isset($destiny[$okey])){
            $destiny[$okey] = $ovalue;
          }
        }
      }
    }

    function mergeFullArrayTo(&$origin, &$destiny){
      if(is_array($origin) && is_array($destiny)){
        foreach($origin as $okey => $ovalue){
            $destiny[$okey] = $ovalue;
        }
      }
    }

    function addCssRef($uri){
        global $global_context;
        if(isset($global_context["css_ref"])){
            $global_context["css_ref"][] = array("uri"=>$uri);
        }else{
            $global_context["css_ref"] = array(array("uri"=>$uri));
        }
    }
    function addJsRef($uri, $first = true){
        global $global_context;
        if(isset($global_context["js_ref"])){
            $global_context["js_ref"][] = array("uri"=>$uri);
        }else{
            $global_context["js_ref"] = array(array("uri"=>$uri));
        }
    }

    function addSelectedCmbArray($arreglo,$atributo,$valor,$selAtributo="selected"){
        for($i = 0 ; $i < count($arreglo); $i++){
          $arreglo[$i][$selAtributo] = ($arreglo[$i][$atributo]==$valor)?"selected":"";
        }
        return $arreglo;
    }

    function sendFile($source,$filename){
      $fp = @fopen($source, 'rb');
      header('Content-Type: "application/octet-stream"');
      header('Content-Disposition: attachment; filename="'.$filename.'"');
      header('Expires: 0');
      header("Content-Transfer-Encoding: binary");
      if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
      {
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
      }
      else
      {
        header('Pragma: no-cache');
      }
      header("Content-Length: ".filesize($yourfile));
      fpassthru($fp);
      fclose($fp);
      die();
    }
?>
