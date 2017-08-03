<?php
/*work with update new version_compare
*2017-07-19
*Created By Belzzesi
*Las Modification 2017-07-19 10:30
*/
  require_once("libs/validadores.php");
  require_once("models/portafolios/portafolios.model.php");
  require_once("models/portafolios/documentos/documentos.model.php");

function run(){
  $viewData = array();
  $viewData["flujos"]=array();
  $viewData["tocken"]="";
  $viewData["errores"]="";
  $viewData["haserrores"]=false;

  $viewData["flujos"]=obtenerFlujosPortafolio($_SESSION["documentoportafolio"]);

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_FILES["uploadfile"])){
      //Obtenemos los datos necesarios para generar el registro
      $udir = "uploads/"; // directorio a donde guardaremos el documento
      $fname = basename($_FILES["uploadfile"]["name"]); //El nombre del archivo
      $fsize = $_FILES["uploadfile"]["size"]; //tamaño en bytes
      //Se puede validar el tamano del archivo
      $tfil =  $udir . md5($fname.time()); //guardamos el archivo con  hash para evitar intruciones directas
      move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $tfil);

      if(updateDocumentosPortfolio($_POST["documentoportafolioflujoactual"],$_POST["documentoportafolioobservacion"],$_SESSION["userCode"], $tfil, $_SESSION["documentoportafolio"] )){
        redirectWithMessage("Documento Actualizado Satisfactóriamente","index.php?page=docuview");
      }else{
        //TODO: Manejar los Errores en la vista.
      }
    }//end if upload
  }

  if($_SESSION["documentoportafolio"]>0){
    $viewData["tocken"] = md5(time()+"docuploadtrn");
    $_SESSION["docupload_tocken"] = $viewData["tocken"];
    $viewData["flujos"]=obtenerFlujosPortafolio($_SESSION["portafoliocodigo"]);
    $docu=obtenerDocumento($_SESSION["documentoportafolio"]);
    mergeFullArrayTo($docu,$viewData);
    $viewData["flujos"] = addSelectedCmbArray($viewData["flujos"],"flujoportafolio", $viewData["documentoportafolioflujoactual"]);

  } //end if
  renderizar("portafolios/documentos/docuversion",$viewData);
//  print_r($viewData);
//  print_r($_SESSION);
}
run();
 ?>
