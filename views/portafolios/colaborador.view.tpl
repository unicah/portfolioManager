<h1>
Gestión de colaboradores
</h1>
<div class="row depth-1 m-padding">
<form action="index.php?page=colaboradores" method="post" class="col-md-8 col-offset-2">
    <div class="row s-padding">
      <label class="col-md-1" for="fltEmail">Correo:&nbsp;</label>
      <input type="email" name="fltEmail"  class="col-md-8"
            id="fltEmail" placeholder="correo@electron.ico" value="{{fltEmail}}" />
      <button class="col-md-3" id="btnFiltro"><span class="ion-refresh">&nbsp;Actualizar</span></button>
    </div>
</form>
</div>
<div class="row depth-1">
<table class="col-md-12">
  <thead>
    <tr>
      <th>Correo</th>
      <th>Nombre</th>
      <th class="sd-hide">Rol</th>
      <th>Añadir</th>

    </tr>
  </thead>
  <tbody class="zebra">
    {{foreach usuarios}}
    <tr>
      <td>{{usuarioemail}}</td>
      <td>{{usuarionom}}</td>
      <td>
        <span class="select col-sm-12"><select {{if readonly}}disabled readonly="readonly" {{endif readonly}} class="col-md-12" id="cmbEstado" name="cmbEstado">
          {{foreach rolUsuarios}}
        <option value="{{codigo}}" {{selected}}>{{valor}}</option>
          {{endfor rolUsuarios}}
    </select> </span>
      </td>
      <td class="center">
        <a href class="btn depth-1 s-margin">
          <span class="ion-plus-circled"></span>
          </a>
        </td>
    </tr>
    {{endfor usuarios}}
  </tbody>
</table>
</div>
<script>
  $().ready(
  function(){
    $("#btnFiltro").click(
      function(e){
        e.preventDefault();
        e.stopPropagation();
        document.forms[0].submit();
      }
    );
  }

  );
</script>
