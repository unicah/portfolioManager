<h1>
  Gestión de portafolios
</h1>
<div class="row depth-1 m-padding">
  <form action="index.php?page=portafolios" method="post" class="col-md-8 col-offset-2">
      <div class="row s-padding">
        <label class="col-md-1" for="fltNombre">BUSCAR:&nbsp;</label>
        <input type="text" name="fltNombre"  class="col-md-8"
              id="fltNombre" placeholder="Ingrese Nombre" value="{{fltNombre}}" />
        <button class="col-md-3" id="btnFiltro"><span class="ion-refresh">&nbsp;Actualizar</span></button>
      </div>
  </form>
</div>
<div class="row depth-1">
  <table class="col-md-12">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Fecha</th>
        <th class="sd-hide">Observación</th>
        <th class="sd-hide">Estado</th>
        <th><a href="index.php?page=portafolio&portafoliocodigo=0&mode=INS" class="btn depth-1 s-margin">
          <span class="ion-plus-circled"></span>
          </a></th>
      </tr>
    </thead>
    <tbody class="zebra">
      {{foreach portafolios}}
      <tr>
        <td>{{portafolionombre}}</td>
        <td>{{portafoliofechacreado}}</td>
        <td class="sd-hide">{{portafolioobservacion}}</td>
        <td class="sd-hide">{{portafolioestado}}</td>
        <td class="center">
          <a href="index.php?page=portafolio&portafoliocodigo={{portafoliocodigo}}&mode=UPD" class="btn depth-1 s-margin"><span class="ion-edit"></span></a>
          <a href="index.php?page=portafolio&portafoliocodigo={{portafoliocodigo}}&mode=DSP" class="btn depth-1 s-margin"><span class="ion-eye"></span></a>
        </td>
      </tr>
      {{endfor portafolios}}
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
