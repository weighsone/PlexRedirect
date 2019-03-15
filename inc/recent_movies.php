<div class="container" id="recent_movies">
	<div class = "text-center">
		<h4>Recently added movies</h4>
		<hr class="dash"/>
	</div>
	<div class = "row mt centered">
		<?php
		include_once("config.php");
		$command = "get_recently_added"; //command used for parsing json - DO NOT CHANGE OR ELSE THE CODE DIES
		$count = "10"; //ammount of recenly added results  - YOU DONT HAVE TO CHANGE THIS
		$ip = "$plexpy_url/api/v2?apikey=$apikey&cmd=$command&section_id=$section_id_movies&count=$count";
		$grab = file_get_contents($ip);
		$jay = json_decode($grab,true);

		$i = 0;
		foreach($jay["response"]["data"]["recently_added"] as $items)
		{
			$output_year = $items['year'] ; //grab year
			$output_tlt = $items['title']; //grab title
			$output_type = $items['media_type']; //grab media type so we can display only movies
			$posterURL = $items['thumb']; //grab poster url
			$rating_key = $items['rating_key'];
			$enc_key =  base64_encode($rating_key);
			
			if($output_type == "movie")
			{
				?>
				<div class = "col-lg-2">
					<img alt="<?php echo $output_tlt;?> Movie poster" class="rounded mx-auto d-block" src="<?php echo $plexpy_addr; ?>/pms_image_proxy?img=<?php echo $posterURL; ?>" />
					<p style="font-size:80%;"><?php echo $output_tlt;?>&nbsp;<?php echo $output_year;?></p>
				</div>
				<?php

				if (++$i == 6) break;
			}
		}//end foreach
		?>
	</div>
</div>