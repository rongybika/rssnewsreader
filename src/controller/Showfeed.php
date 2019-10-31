<?php

//Initialize FeedSimple
$feed = new SimplePie();

if ($auth->isLogged()) {
	// Make sure that page is getting passed a URL
	if (isset($_GET['feedurl']) && $_GET['feedurl'] !== '')
	{
		// Strip slashes if magic quotes is enabled (which automatically escapes certain characters)
		if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
		{
			$_GET['feedurl'] = stripslashes($_GET['feedurl']);
		}

		// Use the URL that was passed to the page in SimplePie
		$feed->set_feed_url($_GET['feedurl']);
	}
} else {
	//if not logged redirect to login page
	echo $twig->render('login.html.twig',['message' => 'Please LogIn']);
	exit;
}

//change cache location
$feed->set_cache_location(__DIR__.'/../../var/cache');

// Run SimplePie.
$feed->init();

// We'll make sure that the right content type and character encoding gets set automatically.
// This function will grab the proper character encoding, as well as set the content type to text/html.
$feed->handle_content_type();

$link = $feed->get_link();
$title = $feed->get_title();

//Let's begin looping through each individual news item in the feed and construct array
foreach($feed->get_items() as $item) {
	$newdata =  array (
		'title' => $item->get_title(),
		'content' => $item->get_content(),
	  );
	  $md_array["feeds"][] = $newdata;
}

//Render the feeds view with data
echo $twig->render('showfeed.html.twig', ['feeds' => $md_array['feeds'] ?? '', 'link' => $link, 'title' => $title, 'islogged' => $auth->isLogged()]);