<?php if (isset($nick) && $rol=='admin'): ?>
<div class="form">
<form method="post" action="<?php APPPATH ?>nuevo">
<h6 class="error" style="color:red;"><?php if(isset($message)) echo $message."\n"; echo validation_errors(); ?></h6>
    <p>Juego:<br />
     <select name="juego"> 
 				<?php  for( $i=0 ; $i < count($juegos); $i++){ ?> 
 					<option value="<?php echo $juegos[$i]->nombre ?>"><?php echo $juegos[$i]->nombre ?></option> 
  				<?php } ?> 
				</select>
    <p>Detalles:<br />
    <textarea rows="5" cols="50" name="detalles" ><?php if(isset($_POST['detalles'])) echo $_POST['detalles']; ?></textarea></p>
    
    <p>Tipo:<br />
     <select name="tipo"> 
     <option value="Torneo">Torneo</option>
     <option value="Desafio">Desafio</option>
     <option value="Competencia">Competencia</option>
     <option value="Reto">Reto</option>
     </select>
			<p>Fecha:<br />
    <input type="date" name="fecha" value="<?php if(isset($_POST['fecha'])) echo $_POST['fecha']; ?>" /></p>
    
    <p>Imagen:<br />
    <input type="texto" name="img" value="http://3.bp.blogspot.com/-yQpjEhqNqW0/UZsYH9P4G_I/AAAAAAAAM6g/-dg7lJARc-w/s640/timthumb.jpg" /></p>
    
    <p><input type="submit" class="button" value="Publicar" /></p>
</form>
</div>
<?php else: ?>
	<h4>Error No tienes permisos Suficientes Para realizar esta accion</h4>
<?php endif; ?>	
