<h1><span class="icon ion-ios-briefcase"></span>&nbsp;{{documentodescripcion}}</h1>
<hr />
<div class="row">
  <div class="col-md-8 col-sm-12">
    <div class="card">
      <section class="panel">
        <header style="position:relative">
            Versiones del Documento
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
  <div class="col-md-4 col-sm-12">
    <div class="card">
      <section class="panel">
        <header style="position:relative">
            Descargas
            <span class="push-right" style="position:absolute;right:1em;top:0.5em;">
              <a href class="btn"><span class="icon ion-ios-cloud-download"></span></a>
            </span>
        </header>
        <main>
            <table class="full-width">
              {{foreach colaboradores}}
                <tr>
                  <td>
                    {{usuarionom}}
                  </td>
                  <td class="center">
                    <a href class="btn"><span class="icon ion-eye"></span></a>
                  </td>
                </tr>
                {{endfor colaboradores}}
            </table>
        </main>
      </section>
      <section class="panel">
        <header style="position:relative">
            Cambios Realizados
            <span class="push-right" style="position:absolute;right:1em;top:0.5em;">
              <a href class="btn"><span class="icon ion-eye"></span></a>
            </span>
        </header>
        <main>
            <table>

            </table>
        </main>
      </section>
      <section class="panel">
        <header style="position:relative">
            Lectura de Documento
            <span class="push-right" style="position:absolute;right:1em;top:0.5em;">
              <a href class="btn"><span class="icon ion-eye"></span></a>
            </span>
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
