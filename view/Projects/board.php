<?php echo "<pre>";
var_dump($_POST);
echo "</pre>"; ?>
<div class="sidebar">
	<header><a href="index.php"><h1>Whiteboard</h1></a></header>
	<ul>
		<li><a href="index.php">Mijn projecten</a></li>
		<li><a class="txt" href="#">Tekst</a></li>
		<li><a class="image" href="#">Afbeelding</a></li>
		<li><a class="video" href="#">Video</a></li>

		<li><a href="index.php?page=notifications">Meldingen <span><?php echo $CountedNotification; ?></span></a></li>
		<li><a class="perstoev" href="#">Persoon toevoegen</a></li>
		<li class="usershover"><a class="usersinboard" href="#">Medegebruikers</a>

		<ul class="users-list">
		    
</ul>
		</li>

		<li class="logout"><a  href="index.php?page=logout">Uitloggen</a></li>
	</ul>
</div>



<ul class="postit-list">
		    
</ul>

<ul class="video-list">
		    
</ul>

<ul class="img-list">
		    
</ul>


<script type="text/template" id="users-template">

	{{#each users}}
		<p class="gebruikers"> {{invited_user_name}}</p>
	{{/each}}
  
</script>

<script type="text/template" id="postit-template">

	{{#each postits}}
		<div class="postit dragdrop">
			<p class="board-tekst">{{tekst}}</p>
		</div>
	{{/each}}
  
</script>

<script type="text/template" id="video-template">

	{{#each video}}
		<div class="dragdrop">
			<video width="400" height="220" controls=true style="left:{{x}}px;">
				<source src="uploads/{{video}}" type="video/mp4">
			</video>
		</div>
	{{/each}}
  
</script>

<script type="text/template" id="img-template">

	{{#each images}}
		<div class="dragdrop">
			<img src="uploads/images/{{photo}}.{{extension}}" class="dragable" alt="" style="left: {{x}}; top: {{y}}">
		</div>
	{{/each}}
  
</script>




<section  id="pop" class="hidden" class="uploadblock">
	<div id="uploadwrap" class="uploadwrap">
	<header>
		<h1>upload</h1>
	</header>

	<div class="close" title="close"></div>
	
		<form action="" method="post" enctype="multipart/form-data" id="tekstupload" class="hideform">
			<fieldset>
					
				<label for="name" class="label" id="name">Post-it</label><br/>
				<textarea required pattern="[A-Za-z].{4,}" name="nieuwtekst" class="txtarea" rows="10" cols="50" value="" placeholder="plaats hier je tekst"></textarea>
				<input type="submit" name="action" id="btnsubmit" value="plaats postit"/>

			</fieldset>
		</form>

		<form action="" method="post" enctype="multipart/form-data" id="imageupload" class="hideform">
			<fieldset>

				<label for="videofile" class="label">Image</label><br/>
				<input type="file" name="image" class="imgupload" required class="addvideo">
				<input type="submit" name="action" id="btnsubmit" value="plaats img"/>

			</fieldset>
		</form>

		<form action="" method="post" enctype="multipart/form-data" id="videoupload" class="hideform">
			<fieldset>

				<label for="name" class="label">Naam filmpje</label><br/>
				<input type="text" required pattern="[A-Za-z].{4,}" class="name" name="name" placeholder="name" value=""/> <br/>
				<label for="videofile" class="label">Video (MP4, max 10MB)</label><br/>
				<input type="file" class="imgupload" name="videofile" required class="addvideo">
				<input type="submit" name="action" id="btnsubmit" value="plaats video"/>

			</fieldset>
		</form>

		<form action="" method="post" enctype="multipart/form-data" id="persoonupload" class="hideform">
			<fieldset>

				<label for="newProjectNaam" class="label">Mensen toevoegen?</label> <br/>
				<input type="search" name="invited" class="name" placeholder="Mensen zoeken" autocomplete="off" value=""/>
				<input type="submit" name="action" id="btnsubmit" value="toevoegen"/>

			</fieldset>
		</form>

			
	</div>
</section>