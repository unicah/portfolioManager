<h1><span class="icon ion-ios-briefcase"></span>&nbsp;{{portafolionombre}}</h1>
<hr />
<div class="row">
  <div class="col-md-8 col-sm-12">
    <div class="card">
      <section class="panel">
        <header style="position:relative">
            Documentos
            <span class="push-right" style="position:absolute;right:1em;top:0.5em;">
              <a href="index.php?page=docupload&mode=INS" class="btn"><span class="icon ion-plus-circled"></span></a>
            </span>
        </header>
        <main >
            <table>
              <thead>
              <tr>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>Categoria</th>
                  <th>Ver</th>
                </tr>
              </thead>
              <tbody class="zebra">

                {{foreach documentos}}
                  <tr>
                     <td>{{documentoportafoliocodigo}}</td>
                     <td>{{documentodescripcion}}</td>
                     <td>{{categoriaportafolionombre}}</td>
                     <td><a href class="btnpw btn depth-1 s-margin" data-docod="{{documentoportafoliocodigo}}"><span class="ion-eye"></span></a></td>
                  </tr>
                {{endfor documentos}}
              </tbody>
            </table>
        </main>
      </section>
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <div class="card">
      <section class="panel">
        <header style="position:relative">
            Colaboradores
            <span class="push-right" style="position:absolute;right:1em;top:0.5em;">
              <a href="index.php?page=colaboradores" class="btn"><span class="icon ion-plus-circled"></span></a>
            </span>
        </header>
        <main>
            <table class="full-width">
              {{foreach colaboradores}}
                <tr>
                  <td>
                    {{usuarionom}}
                  </td>
                  <td class="center" style="width:70px">
                    <a href class="btn"><span class="icon ion-edit"></span></a>
                  </td>
                </tr>
                {{endfor colaboradores}}
            </table>
        </main>
      </section>
      <section class="panel">
        <header style="position:relative">
            Alertas
            <span class="push-right" style="position:absolute;right:1em;top:0.5em;">
              <a href class="btn"><span class="icon ion-plus-circled"></span></a>
            </span>
        </header>
        <main>
            <table>

            </table>
        </main>
      </section>
      <section class="panel">
        <header style="position:relative">
            Categorías
            <span class="push-right" style="position:absolute;right:1em;top:0.5em;">
              <a href class="btn"><span class="icon ion-plus-circled"></span></a>
            </span>
        </header>
        <main>
            <table>
              {{foreach categorias}}
                <tr>
                  <td>
                    {{categoriaportafolionombre}}
                  </td>
                  <td class="center" style="width:70px">
                    <a href="index.php?page=categoria&mode=UPD&code={{categoriaportafolio}}" class="btn"><span class="icon ion-edit"></span></a>
                  </td>
                </tr>
                {{endfor categorias}}

            </table>
        </main>
      </section>
      <section class="panel">
        <header style="position:relative">
            Flujos
            <span class="push-right" style="position:absolute;right:1em;top:0.5em;">
              <a href="index.php?page=editarflujos&mode=INS&code={{flujoportafolio}}" class="btn"><span class="icon ion-plus-circled"></span></a>
            </span>
        </header>
        <main>
          <table class="full-width">
            {{foreach flujos}}
              <tr>
                <td>
                  {{flujoportafolionombre}}
                </td>
                <td class="center" style="width:70px">
                  <a href="index.php?page=editarflujos&mode=UPD&code={{flujoportafolio}}" class="btn"><span class="icon ion-edit"></span></a>
                </td>
              </tr>
              {{endfor flujos}}
          </table>
        </main>
      </section>
    </div>
  </div>
</div>
<script>
  $().ready(
      function(){
        $(".btnpw").click(
          function(e){
            e.preventDefault();
            e.stopPropagation();
            var x = document.createElement("FORM");
            x.action = "index.php?page=docuview";
            x.style= "display:none";
            x.method="POST";
            var y = document.createElement("INPUT");
            y.name="docod";
            y.value=$(this).data('docod');
            x.appendChild(y);
            document.body.append(x);
            x.submit();
          }
        );
      }
  );

</script>
