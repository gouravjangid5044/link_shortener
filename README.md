# link_shortener

Live hosted link => www.shortify.live

Create a .htaccess file in root directory and add this code in it to change permission 

This will hit all the request on index.php page example 

Example
https://domain/shorten_link 

This will hit index.php and shorten_link will be taken from the url and script will perform action on that particular shorten link

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [L,QSA]
```
