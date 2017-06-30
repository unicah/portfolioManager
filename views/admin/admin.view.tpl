<H2>Admin Dashboard</H2>
<hr />
<div class="row">
{{foreach misPortafolios}}
  <div class="col-sm-3 depth-2 portfolio est{{portafolioestado}}">
    <div class="row">
        <div class="col-sm-3">
          <h3 class="center"><a href><span class="icon ion-ios-briefcase"></span></a></h3>
          <div class="center"><span class="icon ion-ios-people"></span>&nbsp;{{portafolio_colaboradores}}</div>
          <div class="center"><span class="icon ion-document-text"></span>&nbsp;{{portafolio_documentos}}</div>
        </div>
        <div class="col-sm-8">
            <h3 class="title">{{portafolionombre}}</h3>
            <div><span class="icon ion-cube"></span>&nbsp;{{departmanetodesc}}</div>
        </div>
    </div>
  </div>
{{endfor misPortafolios}}
</div>
