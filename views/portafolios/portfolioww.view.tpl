<h1><span class="icon ion-ios-briefcase"></span>&nbsp;{{portafolionombre}}</h1>
<hr />
<div class="row">
  <div class="col-md-8 col-sm-12">
    <div class="card">
      <section class="panel">
        <header>
            Documentos
        </header>
        <main>
            <table>

            </table>
        </main>
      </section>
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <div class="card">
      <section class="panel">
        <header>
            Colaboradores
        </header>
        <main>
            <table>
              {{foreach colaboradores}}
                <tr>
                  <td>
                    {{usuarionom}}
                  </td>
                  <td>
                    <a href><span class="icon ion-edit"></span></a>
                  </td>
                </tr>
                {{endfor colaboradores}}
            </table>
        </main>
      </section>
      <section class="panel">
        <header>
            Alertas
        </header>
        <main>
            <table>

            </table>
        </main>
      </section>
      <section class="panel">
        <header>
            Categorías
        </header>
        <main>
            <table>

            </table>
        </main>
      </section>
      <section class="panel">
        <header>
            Flujos
        </header>
        <main>
            <table>

            </table>
        </main>
      </section>
    </div>
  </div>
</div>
