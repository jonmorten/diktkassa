# Diktkassa

A digital baby hatch for poems.

## Requirements

See [Laravel 5.2 Server Requirements](https://laravel.com/docs/5.2#server-requirements)

## Installation

### Get the code

```bash
git clone https://github.com/jjmmkk/diktkassa.git && cd diktkassa && composer install && npm install && bower install && grunt build
```

### Database

Currently only MySQL is supported.

#### Poem table

Create a table to store the poems.

```sql
CREATE TABLE IF NOT EXISTS poems (
	id INTEGER(32) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id),

	created_at VARCHAR(255) NOT NULL,
	rating DECIMAL(7,4) NOT NULL DEFAULT 0.0000,
	text MEDIUMTEXT NOT NULL,
	title VARCHAR(255) NOT NULL,
	updated_at VARCHAR(255) NOT NULL
) ENGINE=InnoDB;
```

#### Poem ratings table

Create a table to store the ratings.

```sql
CREATE TABLE IF NOT EXISTS poem_ratings (
	id INTEGER(32) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id),

	created_at VARCHAR(255) NOT NULL,
	fingerprint VARCHAR(255) NOT NULL,
	poem_id INTEGER(32) NOT NULL,
	rating INTEGER(1) NOT NULL,
	updated_at VARCHAR(255) NOT NULL
) ENGINE=InnoDB;
```

#### Music table

Create a table to store the songs from soundcloud.

```sql
CREATE TABLE IF NOT EXISTS music (
  id int(32) NOT NULL AUTO_INCREMENT,
  poemid int(11) NOT NULL,
  urlalias mediumtext NOT NULL,
  songurl longtext NOT NULL,
  title longtext NOT NULL,
  ogImage longtext NOT NULL,
  PRIMARY KEY (`id`)
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

Copy the file _.env.example_ to _.env_ and replace all the values.

The Google Analytics tracking ID is optional.

### Storage

In the site root, e.g. _/var/www/diktkassa_, create the storage structure

```bash
mkdir -p storage/{app,framework,logs} storage/framework/{cache,sessions,views}
```
