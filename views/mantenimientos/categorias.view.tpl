<h1>
  Gestión de Categoria Portafolio
</h1>
<div class="row depth-1 m-padding">
  <form action="index.php?page=categorias" method="post" class="col-md-8 col-offset-2">
      <div class="row s-padding">
        <label class="col-md-1" for="fltNombre">Buscar:&nbsp;</label>
        <input type="text" name="fltNombre"  class="col-md-8"
              id="fltNombre" placeholder="Nombre de Categoria" value="{{fltNombre}}" />
        <button class="col-md-3" id="btnFiltro"><span class="ion-refresh">&nbsp;Actualizar</span></button>
      </div>
  </form>
</div>
<div class="row depth-1">
  <table class="col-md-12">
    <thead>
      <tr>
        <th>Categoria Portafolio</th>
        <th>Nombre de Categoria</th>
        <th class="sd-hide">Portafolio Nombre</th>
        <th class="sd-hide">Estado</th>
        <th><a href="index.php?page=categoria&categoriaport=&mode=INS" class="btn depth-1 s-margin">
          <span class="ion-plus-circled"></span>
          </a></th>
      </tr>
    </thead>

    <tbody class="zebra">
      {{foreach categorias}}
      <tr>
        <td>{{categoriaportafolio}}</td>
        <td>{{categoriaportafolionombre}}</td>
        <td class="sd-hide">{{portafolionombre}}</td>
        <td class="sd-hide">{{categoriaportafolioestado}}</td>
        <td class="center">
          <a href="index.php?page=categoria&categoriaport={{categoriaport}}&mode=UPD" class="btn depth-1 s-margin"><span class="ion-edit"></span></a>
          <a href="index.php?page=categoria&categoriaport={{categoriaport}}&mode=DSP" class="btn depth-1 s-margin"><span class="ion-eye"></span></a>
        </td>
      </tr>
      {{endfor categorias}}
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
