<?php if (isset($nick) ): ?>
	<h4>Ya estas Logeado</h4>
	<?php else: ?>
<div class="form">
<h6 style="color:white;"><?php echo validation_errors(); ?></h6>
<form method="post" accept-charset="utf-8" action="<?php APPPATH ?>login">
<label>Usuario</label><br>
<input type="text" id="user" name="user"><br><br>
<label>Password</label><br>
<input type="password" id="pass" name="pass">
<br><br>
<input type="submit" value="Enviar">
</form>
</div>
<?php endif; ?>	