<?php 

# Config this the way you want the script to behave
# For help look at the readme
# https://github.com/doefler/Instagram-growth
$conf = array(
	'username' => 'YOUR_USERNAME',
	'access_token' => 'YOUR_ACCESS_TOKEN',
	'debugging' => true,
	'like' => array(
		'do' => true,
		'min_likes' => 20,
		'max_likes' => 0
		),
	'follow' => array(
		'do' => true,
		'min_likes' => 50,
		'max_likes' => 0,
		'like_recent' => array(
				'do' => true,
				'count' => 3
			)
		),
	'comment' => array(
		'do' => false,
		'min_likes' => 80,
		'max_likes' => 0
		)
);

# Insert the tags you want to explore with the script
# Exclude the hashtag itself "#" when you write your tags
# Be aware that the more tags you add, the longer time the script will take to perform.
$tags = array(	
	'TAG_1',
	'TAG_2',
	'TAG_3',
);

# Write different ways of saying hello in comments. 
# These are used randomly when generating comments
$hello = array(	
	'Hey',
	'Hello',
	'Hey there',
	'Hi',
);

# Write different ways of saying complimenting the image in comments. 
# These are used randomly when generating comments
$praise = array(	
	', your picture is really nice',
	', you should visit on YOUR_WEBSITE',
	', cool stuff',
	', have you seen YOUR_BRAND_NAME?',
);

?>