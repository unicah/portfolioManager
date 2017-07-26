<div class="row">
  <div class="col-sm-8">
    <h1>Gestión de colaboradores</h1>
  </div>
  <div class="col-sm-4 right" >
    <h1>
    <a href="index.php?page=docuview" class="btn">
      <span class="ion-arrow-return-left"></span>
    </a>
    </h1>
  </div>
</div>

<div class="row depth-1 m-padding">
<!--form action="index.php?page=colaboradores" method="post" class="col-md-8 col-offset-2"-->
</div>
<div class="row depth-1">
<table class="col-md-12">
  <thead>
    <tr>
      <th class="">Correo</th>
      <th class="">Nombre</th>
      <th class="">Rol</th>
      <th class="">&nbsp;</th>
    </tr>
  </thead>
  <tbody class="zebra">
    {{foreach usuarios}}
    <form action="index.php?page=colaboradoresD" method="post" class="col-md-8 col-offset-2">
    <tr class="">
      <td class="">{{usuarioemail}}</td>
      <td class="">{{usuarionom}}</td>
      <td class="">
        <span class="select col-sm-12">
          {{cmb}}
        </span>
      </td>
      <td class="center">
            <input type="hidden" name="usercod" value="{{usuariocod}}" />

            {{ifnot isUPD}}
            <button type="submit" class="btn depth-1 s-margin" name="mode" value="INS">
              <span class="ion-plus-circled"></span>
            </button>
            {{endifnot isUPD}}

            {{if isUPD}}
            <button type="submit" class="btn depth-1 s-margin" name="mode" value="UPD">
              <span class="ion-edit"></span>
            </button>
            <button type="submit"  class="btn depth-1 s-margin" name="mode" value="DEL">
              <span class="ion-close"></span>
            </button>
            {{endif isUPD}}

      </td>
    </tr>
    </form>
    {{endfor usuarios}}
  </tbody>
</table>
</div>
