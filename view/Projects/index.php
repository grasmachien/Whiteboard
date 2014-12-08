<div class="sidebar">
	<header><a href="index.php"><h1>Whiteboard</h1></a></header>
	<ul>
		<li><a href="index.php"> Mijn projecten</a></li>
		<li>
		
			<form id="searchForm" method="get" action="index.php?action=search">
				<input type="search" name="q" class="search" placeholder="Projecten of gebruikers zoeken" autocomplete="off" value="<?php 
					if (!empty($_GET['q'])) {
				 		echo $_GET['q'];
				 	} ?>">
			</form>
		</li>
		<li><a href="index.php?page=createProject">Nieuw project</a></li>
		<li><a href="">Meldingen</a></li>
		<li><a class="logout" href="index.php?page=logout">Uitloggen</a></li>
	</ul>
</div>

<div class="projecten-overzicht">
	<ul class="projecten-overzicht">
	
	<?php if (!empty($searchResult)) { 
		foreach ($searchResult as $result) { ?>
			<li class="searchResult">
				<?php if (!empty($result['photo'])) { ?>
					<img src="uploads/<?php echo $result['photo']. "_th." . $result['extension']; ?>" alt="<?php echo $result['name']; ?>">
				<?php } else { ?>
					<img src="uploads/nopic.jpg" alt="geen foto">
				<?php } ?>
				<p><?php echo $result['name']; ?></p>
			</li>	
		<?php } ?> 

	<?php 

		} else { 
			if (!empty($projecten)) {
				foreach ($projecten as $project) { ?>
					<li class="project-th">
						<a href="index.php?page=board&amp;name=<?php echo $project['name']; ?>">
							<img src="uploads/<?php echo $project['photo']."_th.". $project['extension']; ?>" alt="">
							<header><h1><?php echo $project['name']; ?></h1></header>
						</a>
					</li>
				<?php } 
			}
		}
		?>
	</ul>
</div>
