<div class="welcome">
<div id="welcome">
    <p>Please <em>login</em> or <em>register</em></p>
</div>
<form method="post" action="" id="loginForm" autocomplete="off" class="form">
	<fieldset>
		<legend>login</legend>
		<div class="cols-2">
			<label for="loginEmail">Email:</label>
			<input class="<?php if(!empty($errors['loginEmail'])) echo ' has-error'; ?>" type="text" id="loginEmail" name="loginEmail" value="<?php if(!empty($_POST['loginEmail'])) echo $_POST['loginEmail'];?>" />
			<span class="error-message<?php if(empty($errors['loginEmail'])) echo ' hidden';?>" data-for="loginEmail"><?php
                if(empty($errors['loginEmail'])) echo 'Please enter the email';
                else echo $errors['loginEmail'];
                ?></span>
		</div>
		<div class="cols-2">
			<label for="loginPassword">Password:</label>
			<input class="<?php if(!empty($errors['loginPassword'])) echo ' has-error'; ?>" type="password" id="loginPassword" name="loginPassword"/>
			<span class="error-message<?php if(empty($errors['loginPassword'])) echo ' hidden';?>" data-for="loginPassword"><?php
                if(empty($errors['loginPassword'])) echo 'Please enter the password';
                else echo $errors['loginPassword'];
                ?></span>
		</div>
		<div>
			<input type="submit" name="action" value="Login" />
		</div>
	</fieldset>
</form>
<form method="post" action="" id="registerForm" autocomplete="off" class="form">
	<fieldset>
		<legend>Register</legend>
		<div class="cols-2">
			<label for="registerEmail">Email:</label>
			<input class="<?php if(!empty($errors['registerEmail'])) echo ' has-error'; ?>" type="text" id="registerEmail" name="registerEmail" value="<?php if(!empty($_POST['registerEmail'])) echo $_POST['registerEmail'];?>" />
			<span class="error-message<?php if(empty($errors['registerEmail'])) echo ' hidden';?>" data-for="registerEmail"><?php
                if(empty($errors['registerEmail'])) echo 'Please enter the email';
                else echo $errors['registerEmail'];
                ?></span>
		</div>
		<div class="cols-2">
			<label for="registerPassword">Password:</label>
			<input class="<?php if(!empty($errors['registerPassword'])) echo ' has-error'; ?>" type="password" id="registerPassword" name="registerPassword" />
			<span class="error-message<?php if(empty($errors['registerPassword'])) echo ' hidden';?>" data-for="registerPassword"><?php
                if(empty($errors['registerPassword'])) echo 'Please enter the password';
                else echo $errors['registerPassword'];
                ?></span>
		</div>
		<div class="cols-2">
			<label for="registerPassword2">Password Again:</label>
			<input class="<?php if(!empty($errors['registerPassword2'])) echo ' has-error'; ?>" type="password" id="registerPassword2" name="registerPassword2" />
			<span class="error-message<?php if(empty($errors['registerPassword2'])) echo ' hidden';?>" data-for="registerPassword2"><?php
                if(empty($errors['registerPassword2'])) echo 'Please enter the password';
                else echo $errors['registerPassword2'];
                ?></span>
		</div>
		<div>
			<input type="submit" name="action" value="Register" />
		</div>
	</fieldset>
</form>
</div>