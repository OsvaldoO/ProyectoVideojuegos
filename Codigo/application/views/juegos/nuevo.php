<?php if (isset($nick) && $rol=='admin'): ?>
<div class="form">
<form method="post" action="<?php APPPATH ?>nuevo">
<h6 class="error" style="color:red;"><?php if(isset($message)) echo $message."\n"; echo validation_errors(); ?></h6>
    <p>Nombre:<br />
    <input type="texto" name="nombre" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>" /></p>
    <p>Tipo:<br />
     <select name="genero"> 
     <option value="accion">Accion</option>
     <option value="carros">Carros</option>
     <option value="deporte">Depote</option>
     <option value="aventura">Aventura</option>
     <option value="pelea">Pelea</option>
     <option value="disparo">Disparos</option>
     </select>
    <p>Imagen:<br />
    <input type="texto" name="imagen" value="<?php if(isset($_POST['imagen'])) echo $_POST['imagen']; ?>" /></p>
    <p><input type="submit" class="button" value="Agregar" /></p>
</form>
</div>
<?php else: ?>
	<h4>Error No tienes permisos Suficientes Para Agregar Juegos</h4>
<?php endif; ?>	