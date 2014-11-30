<div class="sidebar">
	<header><a href="index.php"><h1>Whiteboard</h1></a></header>
	<ul>
		<li><a href="index.php"> Mijn projecten</a></li>
		<li><input type="search" name="q" class="search" placeholder="Projecten zoeken" autocomplete="off" value="<?php 
		if (!empty($_GET['q'])) {
		 	echo $_GET['q'];
		 } ?>"></li>
		<li><a href="index.php?page=createProject">Nieuw project</a></li>
		<li><a href="">Mijn projecten</a></li>
		<li><a href="">Meldingen</a></li>
		<li><a class="logout" href="index.php?page=logout">Uitloggen</a></li>
	</ul>
</div>

<div class="projecten-overzicht">
	
</div>
