<h1>Subir Un Documento</h1>
<div class="row depth-1 m-padding">
  <h2>Nueva Version</h2>
</div>
<div class="row depth-1 m-padding">
  {{if haserrores}}
  <ul class="alert alert-danger depth-1 m-padding" style="list-style:none;">
    {{foreach errores}}
    <li>
      {{this}}
    </li>
    {{endfor errores}}
  </ul>
  {{endif haserrores}}
  <form action="index.php?page=docuversion" method="post" enctype="multipart/form-data" class="col-sm-8 col-sm-offset-2 col-md-6 col-offset-3">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="tocken" value="{{tocken}}" />
    <input type="hidden" name="doccod" value="{{doccod}}" />
    <div class="row">

      <div class="row s-padding">
        <label class="col-sm-5">Código</label>
        <input class="col-sm-7" type="text" name="documentoportafoliocodigo" id="documentoportafoliocodigo" value="{{documentoportafoliocodigo}}" placeholder="Código Documento" readonly/>
      </div>

      <div class="row s-padding">
        <label class="col-sm-5">Descripción</label>
        <input class="col-sm-7"  type="text" name="documentodescripcion" id="documentodescripcion" value="{{documentodescripcion}}" placeholder="Descripción Corta del Documento" max="120" readonly />
      </div>

      <div class="row s-padding">
        <label class="col-sm-5">Categoría</label>
        <span class="select col-sm-7"><select class="col-md-12" id="categoriaportafolio" name="categoriaportafolio " readonly>
        {{foreach categorias}}
          <option value="{{categoriaportafolio}}" {{selected}}>{{categoriaportafolionombre}}</option>
        {{endfor categorias}}
      </select> </span>
      </div>

      <div class="row s-padding">
        <label class="col-sm-5">Estado</label>
        <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="documentoportafolioflujoactual" name="documentoportafolioflujoactual">
        {{foreach flujos}}
          <option value="{{flujoportafolio}}" {{selected}}>{{flujoportafolionombre}}</option>
        {{endfor flujos}}
      </select> </span>
      </div>

      <div class="row s-padding">
        <label class="col-sm-5">Fichero</label>
        <input class="col-sm-7" {{readonly}} type="file" name="uploadfile" id="uploadfile" />
      </div>

      <div class="row s-padding">
        <label class="col-sm-5">Observación</label>
      </div>
      <div class="row s-padding">
        <textarea class="col-sm-12" maxlength="5000" {{readonly}} name="documentoportafolioobservacion" id="documentoportafolioobservacion">{{documentoportafolioobservacion}}</textarea>
      </div>
      <div class="row s-padding">
        <div class="col-md-12 right">

          <button id="btnConfirm"><span class="icon "></span>Confirmar</button>

          <button id="btnCancel">Cancelar</button>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
  $().ready(function() {
    $("#btnConfirm").click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });
    $("#btnCancel").click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=docuview");
    });
  });
</script>
