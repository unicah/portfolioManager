<div class="row">
  <div class="col-md-8 col-sm-12">
    <h1><span class=" icon ion-ios-briefcase "></span>&nbsp;{{documentodescripcion}} ({{flujoportafolionombre}})</h1>
  </div>
  <div class="col-md-4 col-sm-12">
    <div class="card">
      <section class="panel">
        <div class="row">
          <button class="col-sm-6 " id="btnFiltro"><span class="ion-android-download">&nbsp;Descargar</span></button>
          <button class="col-sm-6 "data-docod="{{documentoportafoliocodigo}}" id="btnSubir"><span class="ion-android-upload">&nbsp;Subir</span></button>

        </div>
      </section>
    </div>
  </div>
</div>
<hr />
<div class="row">
  <div class="col-md-8 col-sm-12">
    <div class="card">
      <section class="panel">
        <header style="position:relative">
          Observaciones
        </header>
        <main>
          <table>
            <tbody>
              {{foreach documentos}}
              <tr>
                <td>{{documentoportafoliocodigo}}</td>
                <td>{{documentodescripcion}}</td>
                <td>{{categoriaportafolionombre}}</td>
                <td><a href="" class="btn depth-1 s-margin"><span class="ion-eye"></span></a></td>
              </tr>
              {{endfor documentos}}
            </tbody>
          </table>
        </main>
      </section>
    </div>
    <div class="col-md-12 col-sm-12">
      <div class="card">
        <section class="panel">
          <header style="position:relative">
            Comentarios
          </header>
          <main>
            <table>
              <tbody>
                {{foreach documentos}}
                <tr>
                  <td>{{documentoportafoliocodigo}}</td>
                  <td>{{documentodescripcion}}</td>
                  <td>{{categoriaportafolionombre}}</td>
                  <td><a href="" class="btn depth-1 s-margin"><span class="ion-eye"></span></a></td>
                </tr>
                {{endfor documentos}}
              </tbody>
            </table>
          </main>
        </section>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-sm-12">
    <div class="card">
      <section class="panel">
        <header style="position:relative">
          Resumen
        </header>
        <div class="row">
          <div class="col-sm-3">
            <div class="center"><span class="ion-android-chat"></span>&nbsp;{{portafolio_colaboradores}}</div>
            <div class="center"><span class="icon ion-fork-repo"></span>&nbsp;{{portafolio_documentos}}</div>
          </div>
          <div class="col-sm-8">
            <div><span class="icon ion-ios-people"></span>&nbsp;{{departmanetodesc}}</div>
            <div><span class="icon ion-android-download"></span>&nbsp;{{departmanetodesc}}</div>
          </div>
        </div>
      </section>
      <section class="panel">
        <header style="position:relative">
          Colaboradores
        </header>
        <main>
          <table>
          </table>
        </main>
      </section>
      <section class="panel">
        <header style="position:relative">
          Versiones
        </header>
        <main>
          <table>

          </table>
        </main>
      </section>
    </div>
  </div>
</div>

<script>
  $().ready(
    function() {
      $("#btnSubir").click(
        function(e) {
          e.preventDefault();
          e.stopPropagation();
          var x = document.createElement("FORM");
          x.action = "index.php?page=docuversion";
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
