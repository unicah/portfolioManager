<h1>Gestión de Usuario</h1>
<h2>Modo {{mode}}</h2>
<form action="index.php?page=user" method="post">
  <label>Correo Electrónico</label>
  <input type="text" name="txtCorreo" id="txtCorreo" value="" placeholder="correo@electron.ico" />
  <br />
  <label>Nombre Completo</label>
  <input type="text" name="txtName" id="txtName" value="" placeholder="Nombre Completo" />
  <br />
  <label>Tipo de Usuario</label>
  <select id="cmbTipo" name="cmbTipo">
      <option value="ADM">Administrador</option>
      <option value="USR">Usuario</option>
      <option value="CNS">Consultor</option>
      <option value="CLT">Cliente</option>
  </select>
  <br />
  <label>Departamento</label>
  <select id="cmbDepto" name="cmbDepto">
      <option value="0">Sin Asignar</option>

  </select>
  <br />
  <label>Estado</label>
  <select id="cmbEstado" name="cmbEstado">
      <option value="PND">Sin Activar</option>
      <option value="ACT">Activo</option>
      <option value="SPD">Suspendido</option>
      <option value="INA">Inactivo</option>
  </select>
<br />
<label>Contraseña</label>
<input type="password" name="txtPswd" id="txtPswd" value="" placeholder="Contraseña" />
<br />
<button id="btnConfirm">Confirmar</button>
<button id="btnCancel">Cancelar</button>
</form>
<script>
  $().ready(function(){
      $("#btnConfirm").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        //validaciones de campos en javascript

        //enviar formulario
        //document.forms[0].submit();
        });
        $("#btnCancel").click(function(e){
          e.preventDefault();
          e.stopPropagation();
          window.location.assign("index.php?page=users");
          });
    });
</script>
