<?php if (isset($nick) ): ?>
<div class="form">
<form method="post" action="<?php APPPATH ?>editar">
<h6 class="error" style="color:red;"><?php echo validation_errors(); ?></h6>
    <input type="hidden" name="nick" value="<?php echo $nick ?>" /></p>
    <p>Nombre:<br />
    <input type="texto" name="nombre" value="<?php echo $nombre ?>" /></p>
    
    <p>Email:<br />
    <input type="texto" name="email" value="<?php echo $email ?>" /></p>
    
    <p>Avatar:<br />
    <input type="texto" name="avatar" value="<?php echo $avatar ?>" /></p>
    
    <p><input type="submit" class="button" value="Editar" /></p>
</form>
</div>
<h6 class="session"><?php echo anchor('usuarios/cambiarPass',"Cambiar Password");?></h6>
<?php else: ?>
<h4>No has iniciado Seccion</h4>
<?php endif; ?>										