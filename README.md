# PlexRedirect
a Plex landing page that redirects you to various sites and shows media recently added to Plex
![alt tag](https://i.imgur.com/7EeGslS.png)

This is intended for end user use so there is a common page for them to go to plex or to requst new shows.
The main goal of this was to be fast with minimal nonsense.

## Features:
* Clean, fast interface
* Main links to watching (Plex) and requesting (overseerr)
* Shows recent additions to Plex library
* Recent items link directly to item in Plex
* Pulls data from Tautulli
* Responsive css


## Contributors:
This is a fork of https://github.com/ITRav4/PlexRedirect with some other code from https://github.com/alexanderthegreat96/plexdash
It has been heavily edited/optimised from both though. 

## Installing:
Copy the repo to the web server http root. Webserver just needs to support php (currently based on the 8.x branch of php).
Edit the constants (line 35,36,37)
Optionally edit the library ID (line 51 & 52) 

I have it setup in docker using the php image as the webserver and reverse proxy via caddy for https and public dns via cloudflare.
Docker-compose:
webserver:
    container_name: webserver
    image: php:apache
    build: .
    depends_on:
     - caddy
    ports:
      - "888:80"
    volumes:
      - /dockerdata/caddy/websites:/var/www/html
    restart: unless-stopped

CaddyFile:
domain.com {
	tls <cloudflare_email> {
		dns cloudflare <cloudflare api token>
	}
	reverse_proxy <docker host ip>:888

Then in /dockerdata/caddy/websites drop the files.

## License
Licensed under The MIT License. The Plex logo and name are copyright of Plex Inc.
