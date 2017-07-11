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
        <main>
            <table class="full-width">
              {{foreach colaboradores}}
                <tr>
                  <td>
                    {{usuarionom}}
                  </td>
                </tr>
                {{endfor colaboradores}}
            </table>
        </main>
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
            Lectura de Documento
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
