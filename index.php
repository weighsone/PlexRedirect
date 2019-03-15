<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="plexlanding.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Media Landing</title>
    	
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles -->
    <link href="assets/css/main.css" rel="stylesheet"> 

    <!-- Fonts from Google Fonts -->
    <link href='//fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
  </head>

  <body>
    <div class="container" id="redirectors">
		<div class="row mt centered">
			<div class="col-lg-6">
				<a href="https://app.plex.tv/desktop" target="_top">
				<img src="assets/img/s01.png" width="180" alt="">
				<h4>Watch</h4>
				<p>Log into Plex and start watching</p>
				</a>
			</div>
			<div class="col-lg-6">
				<a href="http://localhost:5000" target="_blank"> <!--URL to Ombi-->
				<img src="assets/img/s02.png" width="180" alt="">
				<h4>Request</h4>
				<p>Want something added?<br \> Request it here</p>
				</a>
			</div>
		</div>
	</div>
	
	<?php
		include("inc/dash_config.php"); //add in config for connection to plex
	?>
	<div class="container" id="link-bar">
		<div class="row centered" id="main">
			<?php 
			if($enable_movies == TRUE)
			{
				include "inc/recent_movies.php";
			}
			if($enable_tvshows == TRUE)
			{
				include "inc/recent_shows.php";
			}
			?>
			<br/>
		</div>
	</div>
  </body>
</html>
