<h1>
  Gestión de Departamentos
</h1>
<div class="row depth-1 m-padding">
  <form action="index.php?page=departamentos" method="post" class="col-md-8 col-offset-2">
      <div class="row s-padding">
<<<<<<< refs/remotes/unicah/develop
        <label class="col-md-1" for="fltDsc">codigo:&nbsp;</label>
        <input type="" name="fltDsc"  class="col-md-8"
              id="fltDsc" placeholder="Buscar departamentos" value="{{fltDsc}}" />
        <button class="col-md-3" id="btnFiltro"><span class="ion-refresh">&nbsp;Actualizar</span></button>


      </div>
  </form>
</div>
<div class="row depth-1">
  <table class="col-md-12">
    <thead>
      <tr>
        <th>Descripción</th>
        <th class="sd-hide">Estado</th>
        <th><a href="index.php?page=departamento&departamentocodigo=0&mode=INS">
          <span class="ion-plus-circled"></span>
          </a></th>
      </tr>
    </thead>
    <tbody class="zebra">
      {{foreach departamento}}
      <tr>
        <td>{{departmanetodesc}}</td>
        <td class="sd-hide">{{departamentoest}}</td>
        <td class="center">
          <a href="index.php?page=departamento&departamentocodigo={{departamentocodigo}}&mode=UPD" class="btn depth-1 s-margin"><span class="ion-edit"></span></a>
          <a href="index.php?page=departamento&departamentocodigo={{departamentocodigo}}&mode=DSP" class="btn depth-1 s-margin"><span class="ion-eye"></span></a>
        </td>
      </tr>
      {{endfor departamento}}
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
