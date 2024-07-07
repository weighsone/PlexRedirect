<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="plexlanding.ico" type="image/x-icon">
    <title>Media Landing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet'>
</head>
<body>
    <div class="container" id="redirectors">
        <div class="row mt centered">
            <div class="col-lg-6">
                <a href="https://app.plex.tv/desktop" target="_top">
                    <img src="assets/img/s01.png" class="redirector-icon overlay" width="35%" alt="">
                    <h4>Watch</h4>
                    <p>Log into Plex and start watching</p>
                </a>
            </div>
            <div class="col-lg-6">
                <a href="https://requests.jono.rocks" target="_blank">
                    <img src="assets/img/s02.png" class="redirector-icon overlay" width="35%" alt="">
                    <h4>Request</h4>
                    <p>Request new things here</p>
                </a>
            </div>
        </div>
    </div>

    <?php
    // Constants
    define('TAUTULLI_ADDR', ''); // Enter address of tautulli like https://tautulli.domain.com
    define('TAUTULLI_APIKEY', '1234567890abcdefghijklmnopqrstuvwxyz'); // Enter tautulli api key from /settings#tabs_tabs-web_interface
    define('SERVER_ID', '1234567890abcdefghijklmnopqrstuvwxyz'); // Enter Plex server ID - you can get this from the URL in Plex when opening any media item. i.e - https://app.plex.tv/desktop/#!/server/1234567890abcdefghijklmnopqrstuvwxyz/details

    // Fetch recently added items
    function fetch_recently_added($section_id, $count) {
        $url = TAUTULLI_ADDR . "/api/v2?apikey=" . TAUTULLI_APIKEY . "&cmd=get_recently_added&section_id=" . $section_id . "&count=" . $count;
        $response = file_get_contents($url);

        if ($response === FALSE) {
            return [];
        }

        return json_decode($response, true)['response']['data']['recently_added'] ?? [];
    }

    $recent_movies = fetch_recently_added(1, 6); // Might need to edit the 1 in this if that isn't the ID of your movies library in Tautulli
    $recent_shows = fetch_recently_added(2, 6); // Might need to edit the 2 in this if that isn't the ID of your movies library in Tautulli

    // Render items
    function render_items($items, $type) {
        $output = '';

        foreach ($items as $index => $item) {
            if ($index >= 6) break;

            $title = $type == 'movies' ? $item['title'] : $item['grandparent_title'];
            $thumb = $type == 'movies' ? $item['thumb'] : $item['grandparent_thumb'];
            $rating_key = $item['rating_key'];
            $url = "https://app.plex.tv/desktop#!/server/" . SERVER_ID . "/details?key=%2Flibrary%2Fmetadata%2F" . $rating_key;

            $movie_year_disp = $type == 'movies' ? "<span> ({$item['year']})</span>" : '';
            $show_html = $type == 'shows' ? "<p class=\"border-top item\">S{$item['parent_media_index']}E{$item['media_index']}: {$item['title']}<br>Aired: {$item['originally_available_at']}</p>" : '';

            $output .= "
            <div class='col-lg-2 item'>
                <a href='$url'>
                    <img alt='$title poster' class='rounded mx-auto d-block media-poster overlay' src='" . TAUTULLI_ADDR . "/pms_image_proxy?img=$thumb&height=250'/>
                </a>
                <p class=\"m-0 item\">$title$movie_year_disp</p>
                $show_html
            </div>";
        }
        return $output;
    }
    ?>

    <div class="container" id="link-bar">
        <div class="row centered" id="main">
            <div id="recent_movies">
                <div class="text-center">
                    <h4>Recently Added Movies</h4>
                    <hr class="dash"/>
                </div>
                <div class="row centered">
                    <?= render_items($recent_movies, 'movies'); ?>
                </div>
            </div>

            <div id="recent_shows">
                <div class="mt text-center">
                    <h4>Recently Added TV Shows</h4>
                    <hr class="dash"/>
                </div>
                <div class="row centered">
                    <?= render_items($recent_shows, 'shows'); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
