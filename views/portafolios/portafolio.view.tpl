<h1>Gestión de Portafolio</h1>
<div class="row depth-1 m-padding">
  <h2>{{modeDesc}}</h2>
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
  <form action="index.php?page=portafolio" method="post" class="col-sm-8 col-sm-offset-2 col-md-6 col-offset-3">
    <input type="hidden" name="mode" value="{{mode}}"  />
    <input type="hidden" name="tocken" value="{{tocken}}"  />
    <input type="hidden" name="portafoliocodigo" value="{{portafoliocodigo}}"  />
    <div class="row">
    <div class="row s-padding">
      <label class="col-sm-5">Nombre</label>
      <input class="col-sm-7" {{readonly}} type="text" name="portafolionombre" id="portafolionombre" value="{{portafolionombre}}" placeholder="Nombre Completo" />
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Departamento</label>
      <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="Cmbdepartamentocodigo" name="Cmbdepartamentocodigo">
        {{foreach departamento}}
          <option value="{{departamentocodigo}}" {{selected}}>{{departmanetodesc}}</option>
        {{endfor departamento}}
      </select> </span>
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Estado</label>
      <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="Cmbportafolioestado" name="Cmbportafolioestado">
        {{foreach estado}}
          <option value="{{codigo}}" {{selected}}>{{valor}}</option>
        {{endfor estado}}
      </select> </span>
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Observación</label>
    </div>
    <div class="row s-padding">
      <textarea class="col-sm-12" maxlength="500" {{readonly}} name="portafolioobservacion" id="portafolioobservacion">{{portafolioobservacion}}</textarea>
    </div>

    <div class="row s-padding">
      <div class="col-md-12 right">
        {{ifnot readonly}}
        <button id="btnConfirm"><span class="icon "></span>Confirmar</button>
        {{endifnot readonly}}
        <button id="btnCancel">Cancelar</button>
      </div>
    </div>
    </div>
  </form>
</div>
<script>
  $().ready(function(){
      $("#btnConfirm").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        document.forms[0].submit();
        });
      $("#btnCancel").click(function(e){
          e.preventDefault();
          e.stopPropagation();
          window.location.assign("index.php?page=portafolios");
          });
    });
</script>
