<div class="sidebar">
	<header><a href="index.php"><h1>Whiteboard</h1></a></header>
	<ul>
		<li><a href="index.php">Mijn projecten</a></li>
		<li><input type="search" name="q" class="search" placeholder="Projecten zoeken" autocomplete="off" value="<?php 
		if (!empty($_GET['q'])) {
		 	echo $_GET['q'];
		 } ?>"></li>

		<li class="logout"><a  href="index.php?page=logout">Uitloggen</a></li>
	</ul>
</div>

<div class="createProjForm">
	<header><h1>Maak een nieuw project aan</h1></header>
	<form action="index.php?page=createProject" method="post" enctype="multipart/form-data">
		<div>
			<label for="newProjectNaam">Naam:</label>
			<input type="text" name="nieuwProjectNaam" id="newProjectNaam" value="<?php if (!empty($_POST['nieuwProjectNaam'])) echo $_POST['nieuwProjectNaam']; ?>">
			 <?php if(!empty($errors['nieuwProjectNaam'])) echo '<span class="error-message">' . $errors['nieuwProjectNaam'] . '</span>'; ?>
		</div>
		<div>
			<label class="col-sm-2 control-label" for="addImageImage">Foto:</label>
	        <input type="file" name="image" id="addImageProject" value="<?php if(!empty($_POST['image'])) echo $_POST['image'];?>" />
	        <span class="error-message"<?php if(empty($errors['image'])) echo 'style="display: none;"';?>>
	        <?php if(!empty($errors['image'])) echo '<span class="error-message">' . $errors['image'] . '</span>'; ?>
		</div>
		
		<div>
			<label for="newProjectNaam">Mensen toevoegen?</label>
				<input type="search" name="invited" class="search" placeholder="Mensen zoeken" autocomplete="off" value=""/>
		</div> 


		<input type="submit" name="action" value="Aanmaken">
	</form>
</div>
