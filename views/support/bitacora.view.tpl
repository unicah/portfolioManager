<h1>Bitacora de Sucesos en PFM</h1>
<div class="row depth-1 m-padding">
  <form action="index.php?page=bitacora" method="post" class="col-md-10 col-offset-1">
      <div class="row s-padding">
        <label class="col-md-1" for="fltprograma">Programa:&nbsp;</label>
        <input type="text" name="fltprograma"  class="col-md-8"
              id="fltprograma" placeholder="Progama" value="{{fltprograma}}" />
      </div>
      <div class="row s-padding">
        <label class="col-md-1" for="fltTipo">Tipo:&nbsp;</label>
        <span class="select col-md-3"><select name="fltTipo" class="col-md-12">
          {{foreach fltTipos}}
            <option value="{{codigo}}" {{selected}}>{{valor}}</option>
          {{endfor fltTipos}}
        </select></span>
        <span class="select col-md-2"><select name="fltMes" class="col-md-12">
          {{foreach fltMeses}}
            <option value="{{codigo}}" {{selected}}>{{valor}}</option>
          {{endfor fltMeses}}
        </select></span>
        <span class="select col-md-3"><select name="fltShowObs" class="col-md-12">
          <option value="0" {{ifnot showobs}}selected{{endifnot showobs}}>No Mostrar JSON</option>
          <option value="1" {{if showobs}}selected{{endif showobs}}>Mostrar JSON</option>
        </select></span>
        <button class="col-md-3" id="btnFiltro"><span class="ion-refresh">&nbsp;Actualizar</span></button>
      </div>
  </form>
</div>
<div class="row depth-1">
  <table class="col-md-12">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Programa</th>
        <th>Usuario</th>
        <th class="sd-hide">Descripción</th>
        <th class="sd-hide">Tipo</th>
      </tr>
    </thead>
    <tbody class="zebra">
      {{foreach bitacoras}}
      <tr>
        <td>{{bitacorafch}}</td>
        <td>{{bitprograma}}</td>
        <td>{{bitusuario}}</td>
        <td class="sd-hide">{{bitdescripcion}}</td>
        <td class="sd-hide">{{bitTipo}}</td>
      </tr>
      {{if showobs}}
      <tr>
        <td colspan="5">
          <pre>
{{jsonpretty}}
          </pre>
        </td>
      </tr>
      {{endif showobs}}
      {{endfor bitacoras}}
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
