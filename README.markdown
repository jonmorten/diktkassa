# Diktkassa

A digital baby hatch for poems.

## Requirements

* A LAMP box
	* MySQL
	* PHP 5.4 or newer
	* [Composer](https://getcomposer.org)
	* _php5-mcrypt_ - you can probably just run `apt-get install php5-mcrypt`
	* [Bower](http://bower.io)

## Installation

### Get the code

```bash
git clone https://github.com/jjmmkk/diktkassa.git && cd diktkassa && composer install && npm install && bower install && grunt build
```

### Database

Currently only MySQL is supported.

#### Table

Create a table to store the poems.

```sql
CREATE TABLE IF NOT EXISTS poems (
	id INTEGER(32) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id),

	created_at VARCHAR(255) NOT NULL,
	text MEDIUMTEXT NOT NULL,
	title VARCHAR(255) NOT NULL,
	updated_at VARCHAR(255) NOT NULL
) ENGINE=InnoDB;
```

### Apache

```apache
<VirtualHost *:80>

	DocumentRoot /var/www/diktkassa/public

	# Laravel
	# http://laravel.com/docs/installation#pretty-urls
	<Directory /var/www/diktkassa/public>
		Options +FollowSymLinks
		RewriteEngine On

		# Force non-www
		RewriteCond %{HTTP_HOST} www.(.*)$ [NC]
		RewriteRule ^(.*)$ http://%1/$1 [R=301,L]

		# Redirect trailing slashes
		RewriteRule ^(.*)/$ /$1 [L,R=301]

		# Handle front controller
		RewriteCond %{REQUEST_FILENAME} !-d
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteRule ^ index.php [L]
	</Directory>

</VirtualHost>
```

### Environment file

In the site root, e.g. _/var/www/diktkassa_, create the file _.env.php_. Base it on this template - replace the values:

```php
<?php

return [
	'database' => [
		'host' => 'localhost',
		'database' => 'diktkassa',
		'username' => 'diktkassa',
		'password' => 'diktkassa',
	],
	'ga_tracking_id' => 'UA-XXXXXXXX-X',
	'mandril_api_key' => 'ABCDEFGHIJKLMNOPQRSTUV',
	'meta_description' => 'A digital baby hatch for poems.',
	'poem_email' => 'your@email.com',
];
```

The Google Analytics tracking ID is optional.

### Storage

In the site root, e.g. _/var/www/diktkassa_, create the storage structure

```bash
mkdir -p app/storage/{cache,logs,meta,sessions,views}
```
