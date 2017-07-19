<h1><span class="icon ion-ios-briefcase"></span>&nbsp;{{documentodescripcion}} ({{flujoportafolionombre}})</h1>
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
            <span class="push-right" style="position:absolute;right:1em;top:0.5em;">
              <a href="index.php?page=colaboradores&portacod={{portafoliocodigo}}&mode=INS" class="btn"><span class="icon ion-plus-circled"></span></a>
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
                    <a href="index.php?page=colaboradoreditar&usrcod={{usuariocod}}&mode=UPDD" class="btn"><span class="icon ion-edit"></span></a>
                  </td>
                </tr>
                {{endfor colaboradores}}
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
        <main>
            <table>

            </table>
        </main>
      </section>
    </div>
  </div>
</div>
