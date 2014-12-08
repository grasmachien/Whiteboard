<div class="sidebar">
	<header><a href="index.php"><h1>Whiteboard</h1></a></header>
	<ul>
		<li><a href="index.php">Mijn projecten</a></li>
		<li><a href="">Meldingen <span><?php echo $CountedNotification; ?></span></a></li>

		<li><a class="logout" href="index.php?page=logout">Uitloggen</a></li>
	</ul>
</div>

<?php if (!empty($Notifications)) {
		
	
	 	foreach($Notifications as $Notification): ?>
			<p><?php echo $Notification["invited_user_name"]; ?> would like to join <?php echo $Notification["project_name"]; ?></p>

		<form action="" method="post" id="notification" >
			<fieldset>

				<input type="hidden" name="invitedid" value="<?php echo $Notification["invite_id"]; ?>"/>
				<input type="submit" name="action"  value="toestaan"/>
				<input type="submit" name="action"  value="verwijderen"/>

			</fieldset>
		</form>
<?php
		endforeach; 
	}
?>