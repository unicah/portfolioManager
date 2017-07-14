<h1>Editar colaborador</h1>
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
  <form action="index.php?page=colaboradoreditar" method="post" class="col-sm-8 col-sm-offset-2 col-md-6 col-offset-3">
    <input type="hidden" name="mode" value="{{mode}}"  />
    <input type="hidden" name="tocken" value="{{tocken}}"  />
    <input type="hidden" name="usrcod" value="{{usrcod}}"  />
    <div class="row">

    <div class="row s-padding">
      <label class="col-sm-5">Correo Electrónico</label>
      <input class="col-sm-7" readonly type="text" name="txtCorreo" id="txtCorreo" value="{{usuarioemail}}" placeholder="correo@electron.ico" />
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Nombre Completo</label>
      <input class="col-sm-7" readonly type="text" name="txtName" id="txtName" value="{{usuarionom}}" placeholder="Nombre Completo" />
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Rol</label>
        <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="cmbTipo" name="cmbTipo">
          {{foreach rolUsuarios}}
            <option value="{{codigo}}" {{selected}}>{{valor}}</option>
          {{endfor rolUsuarios}}
      </select></span>
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Estado</label>
      <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="cmbEstado" name="cmbEstado">
        {{foreach estadoUsuarios}}
          <option value="{{codigo}}" {{selected}}>{{valor}}</option>
        {{endfor estadoUsuarios}}
      </select> </span>
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
  $().ready(function(){
      $("#btnConfirm").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        document.forms[0].submit();
        });
      $("#btnCancel").click(function(e){
          e.preventDefault();
          e.stopPropagation();
          window.location.assign("index.php?page=portafolioww");
          });
    });
</script>
