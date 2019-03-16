<div class="container" id="recent_movies">
	<div class = "text-center">
		<h4>Recently added TV shows</h4>
		<hr class="dash"/>
	</div>
	<div class = "row mt centered">
		<?php
		include_once("config.php");
		$command = "get_recently_added"; //command used for parsing json - DO NOT CHANGE OR ELSE THE CODE DIES
		$count = "6"; //ammount of recenly added results  - YOU DONT HAVE TO CHANGE THIS
		$ip = "$plexpy_url/api/v2?apikey=$apikey&cmd=$command&section_id=$section_id_shows&count=$count";
		$grab = file_get_contents($ip);
		$jay = json_decode($grab,true);
		$i = 0;

		foreach($jay["response"]["data"]["recently_added"] as $items)
		{
		$output_year = $items['year'] ; //grab year
		$output_tlt = $items['grandparent_title']; //grab series title
		$output_ep_tlt = $items['title']; //grab episode title
		$rating_key = $items['rating_key'];
		$output_title = $items["title"];
		$posterURL = $items['grandparent_thumb']; //grab poster url
		$enc_key =  base64_encode($rating_key);

		?>
		<div class = "col-lg-2">
			<img alt="<?php echo $output_tlt;?> TV Show poster" class="rounded mx-auto d-block media-poster" src="<?php echo $plexpy_addr; ?>/pms_image_proxy?img=<?php echo $posterURL; ?>" />
			<p class="border-bottom" style="font-size:80%;margin-bottom:0px;"><?php echo $output_tlt;?></p><p style="font-size:80%;"><?php echo $output_ep_tlt?></p>
		</div>
		<?php	} //end loop	?>
	</div>
</div>
