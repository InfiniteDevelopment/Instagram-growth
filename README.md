# Instagram-growth
Grow your Instagram follower base using this script.
This will use your own account to get real followers that interact with the tags your setup.

Follow me @doefler on twitter to know about updates on this scipt.
Please let me know if you would like any other cool features or how this script works for you.

The maximum number of requests per hour has been exceeded. You have made 46 requests of the 30 allowed in the last hour.

## Setup
### Download the script to your server

### Edit the config file (config.php)
```PHP
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
```


### access_token
Get new token https://instagram.com/developer/api-console/
#### Step 1
Start by authenticating the console by signing in with your own instagram
Click "OAuth 2" in the dropdown box
![](https://raw.githubusercontent.com/doefler/Instagram-growth/master/img/get-authentication.png)
Then click the "Sign in with Instagram" button
![](https://raw.githubusercontent.com/doefler/Instagram-growth/master/img/signin-with-instagram.png)
#### Step 2
Select a one of the urls from the pull out menu on the left
Run this request by clicking the orange "Send" button on the right
![](https://raw.githubusercontent.com/doefler/Instagram-growth/master/img/select-a-url-to-run.png)
#### Step 3
Your access token for the config can now be found in the left window with the headline "Request"
Copy the value of the access_token (Be aware that it extends to the right behind the vertical window divider)
![](https://raw.githubusercontent.com/doefler/Instagram-growth/master/img/select-the-access-token.png)




### cronjob (optional)
Run this script periodically with a cronjob.
Add a cronjob in linux

Great intro to setting up a cronjob from linux command line
Open the cronjob editor in linux shell
```
$ crontab -e
```
Run the script once an hour at xx:00 o'clock
```
0 * * * * /PATH_TO_SCRIPT/FILE.PHP
```
The code to run the script
```
php /PATH_TO_SCRIPT/instagram-growth.php
```
To prevent the code from waiting for the output of the script we add a little something to the end of it
```
php /PATH_TO_SCRIPT/instagram-growth.php > /dev/null 2>/dev/null &
```
In the end the code for the crontab looks like this
```
0 * * * * php /PATH_TO_SCRIPT/instagram-growth.php > /dev/null 2>/dev/null &
```

A great guide on how to do other settings with the cronjob
http://www.cyberciti.biz/faq/how-do-i-add-jobs-to-cron-under-linux-or-unix-oses/



## Requirements
### cURL

Install the curl module for PHP using the package manager
```
sudo apt-get install php5-curl
```
You will need to restart the server afterwards
```
sudo service apache2 restart
```
Reference
http://askubuntu.com/questions/9293/how-do-i-install-curl-in-php5


## TL;DR
### Time between likes
### Relikes the same content


### Best practices for gaining instagram followers
http://austenallred.com/user-acquisition/book/chapter/instagram/