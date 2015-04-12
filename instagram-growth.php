<?php 

# Include the configurations you have made to the script
include_once('config.php');

# This varible help stop the script if it has performed too many requests to the API
$break = false;

# Define the varible for later use
$like_recent = array();


foreach ($tags as $i => $tag) {
	$res = insta_connect('https://api.instagram.com/v1/tags/'.$tag.'/media/recent', 'get');
	if($break)break;
	
	foreach ($res['data'] as $ii => $ee) {
		if($break)break;
		$actions = '';

		if($conf['like']['do']
		 && ($conf['like']['min_likes'] == 0 || $ee['likes']['count'] > $conf['like']['min_likes'])
		 && ($conf['like']['max_likes'] == 0 || $ee['likes']['count'] < $conf['like']['max_likes'])
		){
			$actions .= '
			Liked content: ' . (string)json_encode(insta_connect('https://api.instagram.com/v1/media/'.$ee['id'].'/likes', 'post'));
		}

		if($conf['follow']['do']
		 && ($conf['follow']['min_likes'] == 0 || $ee['likes']['count'] > $conf['follow']['min_likes'])
		 && ($conf['follow']['max_likes'] == 0 || $ee['likes']['count'] < $conf['follow']['max_likes'])
		){
			$actions .= '
			Follows user: ' . (string)json_encode(insta_connect('https://api.instagram.com/v1/users/'.$ee['user']['id'].'/relationship', 'post','action=follow'));
			$like_recent[] = $ee['user']['id'];
		}

		// Prevent commenting more than once
		if($conf['comment']['do']
		 && ($conf['comment']['min_likes'] == 0 || $ee['likes']['count'] > $conf['comment']['min_likes'])
		 && ($conf['comment']['max_likes'] == 0 || $ee['likes']['count'] < $conf['comment']['max_likes'])
		 && !username_in_array($ee['comments']['data'])
		){
			$text = comment_gen($ee['user']['username']);
			$text = urlencode($text);
			$actions .= '
			Comment image: ' . (string)json_encode(insta_connect('https://api.instagram.com/v1/media/'.$ee['id'].'/comments', 'post','text='.$text));
		}


		if($conf['debugging']) $data[] = array(
			//'tags' => $ee['tags'], 
			'comments_count' => $ee['comments']['count'], 
			'created_time' => $ee['created_time'], 
			'created_time_formatted' => date('H:i d-m-Y',$ee['created_time']), 
			'like_count' => $ee['likes']['count'], 
			'image' => $ee['images']['standard_resolution']['url'], 
			'username' => $ee['user']['username'], 
			'user_id' => $ee['user']['id'], 
			'id' => $ee['id'],
			'actions' => $actions,
		);

	}

	if($conf['debugging']){
		$instart[] = $data;
		unset($data);
	}
}

if($conf['follow']['like_recent']['do'] && is_array($like_recent)){
	foreach ($like_recent as $i => $user) {
		if($break)break;

		$res = insta_connect('https://api.instagram.com/v1/users/'.$user.'/media/recent', 'get');
		$actions = '';
		$count = 0;

		foreach ($res['data'] as $ii => $ee) {
			if($count < $conf['follow']['like_recent']['count']){
				$actions .= '
				Liked content: ' . (string)json_encode(insta_connect('https://api.instagram.com/v1/media/'.$ee['id'].'/likes', 'post'));
			}
			$count++;
		}

		if($conf['debugging']){
			$data[] = array(
				'actions' => $actions,
			);	

			$instart[] = $data;
			unset($data);
		}
	}
}

# Outputting the result of the performed actions
# If debugging is turned on, the details of each action will be outputted
if($conf['debugging']){
	echo '<pre>';
	print_r($instart);
} else {
	echo 'done running the script';
}

# This outputs if the script has been canceled because of to many requests
if($break) echo 'Script was terminated because of too many requests';





# Custom function for getting and posting to the instagram API
# The script require cURL to run
function insta_connect($url, $method = 'get', $body=''){
	global $conf,$break;
	$url = $url.'?access_token='.$conf['access_token'];

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERAGENT, 			"Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 		1 );

	if($method == 'post'){	
		curl_setopt($ch, CURLOPT_POST,        		1 );
		curl_setopt($ch, CURLOPT_POSTFIELDS,    	$body); 
		curl_setopt($ch, CURLOPT_HTTPHEADER,   		array('Content-Type: text/plain','charset=UTF-8')); 
	} else {
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,	1 );
	}

	$res = curl_exec($ch);
	curl_close($ch);


	$res = (json_decode($res,true));
	if($res['meta']['code'] == 429)$break = true;

	return $res;
}

# This helper function will generate random comments based on the provided "hello" and "praise" text above
function comment_gen($username){
	global $hello, $praise;
	return $hello[array_rand($hello)].' '.'@'. $username . '' . $praise[array_rand($praise)];
}

# This function checks if your username has already/recently commented on the image
# It does however not explore all the comments, which mean that you can possibly end up commenting more than once
# Use at your own risk :P
function username_in_array($data){
	global $conf;
	foreach ($data as $i => $e) {
		if($e['from']['username'] == $conf['username'])return true;
	}

	return false;
}




?>