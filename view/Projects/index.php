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
		<li><a href="index.php?page=notifications">Meldingen <span><?php echo $CountedNotification; ?></span></a></li>
		<li class="logout"><a  href="index.php?page=logout">Uitloggen</a></li>
	</ul>
</div>

<div class="projecten-overzicht">
	<ul class="projecten">
	<div class="result"></div>
	
	<?php if (!empty($searchResult)) { 
		foreach ($searchResult as $result) { ?>
			<li class="project-th">
				<div class="imgproject">
					<?php if (!empty($result['photo'])) { ?>
						<img class="projectimg" src="uploads/<?php echo $result['photo']. "_th." . $result['extension']; ?>" alt="<?php echo $result['name']; ?>">
					<?php } else { ?>
						<img src="uploads/nopic.jpg" alt="geen foto">
					<?php } ?>
					<header><h1><?php echo $result['name']; ?></h1></header>
				</div>

				<form action="" method="post" class="invitebtn">
				<fieldset>
					<input type="hidden" name="projectnaam" value="<?php echo $result["name"]; ?>"/>
					<input type="submit" name="action"  value="request_invite"/>
				</fieldset>
			</form>
			</li>	
			
		<?php } ?> 

	<?php 

		} else { 
			if (!empty($projecten)) {
				foreach ($projecten as $project) { ?>
					<li class="project-th">
					<div class="imgproject">
						<a href="index.php?page=board&amp;name=<?php echo $project['name']; ?>">
							<img class="projectimg" src="uploads/<?php echo $project['photo']."_th.". $project['extension']; ?>" alt="<?php echo $project['photo']; ?>">
							
						</a>
					</div>
					<header><h1><?php echo $project['name']; ?></h1></header>
					</li>
					
				<?php } 
			}
		}
		?>
	</ul>
</div>
