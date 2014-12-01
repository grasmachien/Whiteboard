<div class="sidebar">
	<header><a href="index.php"><h1>Whiteboard</h1></a></header>
	<ul>
		<li><a href="index.php">Mijn projecten</a></li>
		<li><input type="search" name="q" class="search" placeholder="Projecten zoeken" autocomplete="off" value="<?php 
		if (!empty($_GET['q'])) {
		 	echo $_GET['q'];
		 } ?>"></li>
		<li><a class="txt" href="#">tekst</a></li>
		<li><a class="video" href="#">video</a></li>
		<li><a href="index.php">Mijn projecten</a></li>
		<li><a href="">Meldingen</a></li>
		<li><a class="logout" href="index.php?page=logout">Uitloggen</a></li>
	</ul>
</div>

<?php if (!empty($existingTekst)) {
		
	
	 	foreach($existingTekst as $existing): ?>
			<p><?php echo $existing["tekst"]; ?></p>
<?php
		endforeach; 
	}
?>

<?php if (!empty($existingVideo)) {
		
	
	 	foreach($existingVideo as $video): ?>
			<video autoplay loop width="400" height="220" controls=true>
				<source src="uploads/<?php echo $video['video']; ?>" type="video/mp4">
			</video>
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

<section  id="popvideo" class="hidden" class="uploadblock">
	<div id="uploadwrapvideo" class="uploadwrap">
	<header>
		<h1>Video</h1>
	</header>

	<div class="close" title="close"></div>
	
		<form action="" method="post" enctype="multipart/form-data">
			<fieldset>

					<label for="name" id="name">name</label><br/>
					<input type="text" required pattern="[A-Za-z].{4,}" class="name" name="name" placeholder="name" value=""/>
					<label for="videofile">Video (MP4, max 10MB)</label><br/>
					<input type="file" name="videofile" required class="addvideo">
					<input type="submit" name="action" id="btnsubmit" value="upload"/>

			</fieldset>
		</form>
	</div>
</section>