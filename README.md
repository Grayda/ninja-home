ninja-home
==========

A Windows 8-like UI for the Gray Household's Ninja Block. Can actuate lights, display webcam info and has a Twitter-based message board for logging info, leaving messages or displaying important info

##Getting Started

1. Go to https://apps.twitter.com/app/new and register a new application.

2. Click the button to test OAuth and get the consumer secret, consumer key, access token and access secret.

3. Go to http://a.ninja.is/hacking and get an API Access Token

4. Edit config.php and put all this info you collected, into there. Also change the twitter username


5. Create a new database called "ninjaDash". Within it, create a table called "dismissed" with one column called "id" (bigint). This holds your dismissed notifications

6. Load and enjoy!

##Using the Twitter board

You can use the Twitter functionality to display messages, errors and just about anything else you could want. The Twitter function supports the following hashtags:

\#log - General logging stuff

\#info - More important stuff, such as doorbell rings etc.

\#error - Something has gone wrong! Uh oh!

\#quad - Display a 4-wide tile

\#hide - Stuff not meant to be displayed

\#message - A message left for someone

\#modal - Pops up a window you must dismiss

\#half - A smaller sized tile (actually normal size, but default is double)

\#sticky - Makes this tweet appear at the top of the list (but only while it's still within $twitterAmount)

##Roadmap


* ~~Make dialog boxes stay dismissed (cookies or MySQL)~~

* ~~Make the Twitter feed auto-reload~~

* ~~Make an array to hold items to actuate (like the webcams)~~

* Create a separate panel to hold various tweets (#hide tweets, #log tweets, previously dismissed tweets)

* Make tapping on webcam images bring up a bigger version

* Add a place in the user_id part for temperature

* Jazz up the background

##Known issues

* This thing will chew through your hourly Twitter API limit, so set reloading times accordingly

* Modals are mostly fixed, but a loop error causes timeouts and other issues when all your tweets are dismissed and there are no more to grab.