<div class="sidebar">
	<header><a href="index.php"><h1>Whiteboard</h1></a></header>
	<ul>
		<li><a href="index.php">Mijn projecten</a></li>
		<li><input type="search" name="q" class="search" placeholder="Projecten zoeken" autocomplete="off" value="<?php 
		if (!empty($_GET['q'])) {
		 	echo $_GET['q'];
		 } ?>"></li>
		<li><a class="txt" href="#">tekst</a></li>
		<li><a href="index.php">Mijn projecten</a></li>
		<li><a href="">Meldingen</a></li>
		<li><a class="logout" href="index.php?page=logout">Uitloggen</a></li>
	</ul>
</div>

<?php
	if (!empty($existingTekst)) {
		
	
	 	foreach($existingTekst as $existing): ?>
			<p><?php echo $existing["tekst"]; ?></p>
<?php
		endforeach; 
	}
?>



<section  id="pop" class="hidden" class="uploadblock">
	<div id="uploadwrap" class="uploadwrap">
	<header>
		<h1>tekst</h1>
	</header>

	<div class="close" title="close"></div>
	
		<form action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<label for="name" id="name">tekst</label><br/>
				<input type="text" required pattern="[A-Za-z].{4,}" class="name" name="nieuwtekst" placeholder="tekst" value=""/>
				<input type="submit" name="action" id="btnsubmit" value="nieuwtekst"/>
			</fieldset>
		</form>
	</div>
</section>