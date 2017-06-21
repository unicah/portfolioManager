<h1>
  Gestión de Programas
</h1>
<div class="row depth-1 m-padding">
  <form action="index.php?page=programas" method="post" class="col-md-8 col-offset-2">
      <div class="row s-padding">
        <label class="col-md-1" for="fltNombre">Buscar:&nbsp;</label>
        <input type="text" name="fltNombre"  class="col-md-8"
              id="fltNombre" placeholder="Codigo del programa" value="{{fltNombre}}" />
        <button class="col-md-3" id="btnFiltro"><span class="ion-refresh">&nbsp;Actualizar</span></button>
      </div>
  </form>
</div>
<div class="row depth-1">
  <table class="col-md-12">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Descripción</th>
        <th class="sd-hide">Estado</th>
        <th class="sd-hide">Tipo</th>
<<<<<<< Updated upstream
        <th><a href="">
=======
        <th><a href="index.php?page=programa&programacod=0&mode=INS">
>>>>>>> Stashed changes
          <span class="ion-plus-circled"></span>
          </a></th>
      </tr>
    </thead>
    <tbody class="zebra">
      {{foreach programas}}
      <tr>
        <td>{{programacod}}</td>
        <td>{{programadsc}}</td>
        <td class="sd-hide">{{programaest}}</td>
        <td class="sd-hide">{{programatyp}}</td>
        <td class="center">
<<<<<<< Updated upstream
          <a href="" class="btn depth-1 s-margin"><span class="ion-edit"></span></a>
          <a href="" class="btn depth-1 s-margin"><span class="ion-eye"></span></a>
=======
          <a href="index.php?page=programa&programacod={{programacod}}&mode=UPD" class="btn depth-1 s-margin"><span class="ion-edit"></span></a>
          <a href="index.php?page=programa&programacod={{programacod}}&mode=DSP" class="btn depth-1 s-margin"><span class="ion-eye"></span></a>
>>>>>>> Stashed changes
        </td>
      </tr>
      {{endfor programas}}
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
