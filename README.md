# Instagram-growth
Grow your Instagram follower base using this script.

Follow me @doefler on twitter to know about updates on this scipt.
Please let me know if you would like any other cool features or how this script works for you.

The maximum number of requests per hour has been exceeded. You have made 46 requests of the 30 allowed in the last hour.

## Setup
### access_token
Get new token https://instagram.com/developer/api-console/
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
0 * * * * /path to script
```
The code to run the script
```
php /PATH_TO_SCRIPT/classes.instagram.php
```
To prevent the code from waiting for the output of the script we add a little something to the end of it
```
php /PATH_TO_SCRIPT/classes.instagram.php > /dev/null 2>/dev/null &
```
In the end the code for the crontab looks like this
```
0 * * * * php /PATH_TO_SCRIPT/classes.instagram.php > /dev/null 2>/dev/null &
```

A great guide on how to do other settings with the cronjob
http://www.cyberciti.biz/faq/how-do-i-add-jobs-to-cron-under-linux-or-unix-oses/



## Requirements
### cURL

I believe that the package php5-curl should do the trick. Use the package manager of your choice and the deps should be taken care of.
```
sudo apt-get install php5-curl
```
You will need to restart the server afterwards:
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