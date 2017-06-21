<h1>Gestión de Programas</h1>
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
<<<<<<< Updated upstream
  <form action="index.php?page=user" method="post" class="col-sm-8 col-sm-offset-2 col-md-6 col-offset-3">
    <input type="hidden" name="mode" value="{{mode}}"  />
    <input type="hidden" name="tocken" value="{{tocken}}"  />
    <input type="hidden" name="usrcod" value="{{usrcod}}"  />
    <div class="row">
    <div class="row s-padding">
      <label class="col-sm-5">Correo Electrónico</label>
      <input class="col-sm-7" {{readonly}} type="text" name="txtCorreo" id="txtCorreo" value="{{usuarioemail}}" placeholder="correo@electron.ico" />
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Nombre Completo</label>
      <input class="col-sm-7" {{readonly}} type="text" name="txtName" id="txtName" value="{{usuarionom}}" placeholder="Nombre Completo" />
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Tipo de Usuario</label>
        <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="cmbTipo" name="cmbTipo">
          {{foreach tipoUsuarios}}
            <option value="{{codigo}}" {{selected}}>{{valor}}</option>
          {{endfor tipoUsuarios}}
      </select></span>
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Departamento</label>
        <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="cmbDepto" name="cmbDepto">
          <option value="0">Sin Asignar</option>

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
    {{ifnot readonly}}
    <div class="row s-padding">
      <label class="col-sm-5">Contraseña</label>
      <input class="col-sm-7" {{readonly}} type="password" name="txtPswd" id="txtPswd" value="" placeholder="Contraseña" />

    </div>
=======
  <form action="index.php?page=programa" method="post" class="col-sm-8 col-sm-offset-2 col-md-6 col-offset-3">
    <input type="hidden" name="mode" value="{{mode}}"  />
    <input type="hidden" name="tocken" value="{{tocken}}"  />
    <input type="hidden" name="programacod" value="{{programacod}}"  />
    <div class="row">
      <div class="row s-padding">
        <label class="col-sm-5">Código del programa: </label>
        <input class="col-sm-7" {{readonly}} type="text" name="txtCodigo" id="txtCodigo" value="{{programacod}}" placeholder="Código del programa" />
      </div>
    <div class="row s-padding">
      <label class="col-sm-5">Descripción del programa: </label>
      <input class="col-sm-7" {{readonly}} type="text" name="txtDescripcion" id="txtDescripcion" value="{{programadsc}}" placeholder="Descripción del programa" />
    </div>
    <div class="row s-padding">
      <label class="col-sm-5">Estado</label>
      <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="cmbEstado" name="cmbEstado">
        {{foreach estadoProgramas}}
          <option value="{{codigo}}" {{selected}}>{{valor}}</option>
        {{endfor estadoProgramas}}
      </select> </span>
    </div>

    <div class="row s-padding">
      <label class="col-sm-5">Tipo de proyecto</label>
        <span class="select col-sm-7"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="cmbTipo" name="cmbTipo">
          {{foreach tipoProgramas}}
            <option value="{{codigo}}" {{selected}}>{{valor}}</option>
          {{endfor tipoProgramas}}
      </select></span>
    </div>

    {{ifnot readonly}}
>>>>>>> Stashed changes
    {{endifnot readonly}}
    <div class="row s-padding">
      <div class="col-md-12 right">
        {{ifnot readonly}}
<<<<<<< Updated upstream
        <button id="btnConfirm"><span class="icon "></span>Confirmar</button>
=======
        <button id="btnConfirm"><span class=""></span>Confirmar</button>
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
          window.location.assign("index.php?page=users");
=======
          window.location.assign("index.php?page=programas");
>>>>>>> Stashed changes
          });
    });
</script>
