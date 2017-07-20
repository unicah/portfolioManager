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
  $docu = array();
  $viewData["flujos"]=obtenerFlujosPortafolio($_SESSION["documentoportafoliocodigo"]);
  $docu=obtenerDocumento($_SESSION["documentoportafoliocodigo"]);
  mergeFullArrayTo($docu,$viewData);
  $viewData["flujos"] = addSelectedCmbArray($viewData["flujos"],"flujoportafolio", $viewData["documentoportafolioflujoactual"]);

  renderizar("portafolios/documentos/docuversion",$viewData);
}
run();
 ?>
