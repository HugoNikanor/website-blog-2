# website-blog-2
## Usage
Good luck with that.
But I kinda have tested that it works with both php5 and php7.0

## Dependencies
The project have two dependencies, parsedown and my own comment system.
Both of these are handled as git sub module. To download the project with all
sub modules just run:

	git clone --recursive https://github.com/hugonikanor/website-blog-2.git

Also, in the ``./website-comment-system`` directory there is a file named 
``database.ini``, make sure that the file is not accessible over the server.

## Files & Configuration


All blog entries should be put into `./entries`.
They all should be named on the form `YYYYMMDDtitle.md`, where `title` can be
anything. The first line *must* be on the form
```md
# Fancy written title
```

#### special-files.ini

Links which should appear in the footer should be put into the directory
`footnotes`, and entered into `footnote.files` and `footnote.title` in
`special-files.ini`.

`other.files` should probably not be touched.

```ini
[footnote]
files[] = about.md
title[] = About
```

#### settings.php

Remaining settings can be set in `settings.php`.

```php
<?php
$author = "Hugo Hornquist";
$blog_title = "HugoNikanors blogg‽";
$blog_subtitle = "A blog about nothing, but mostly itself.";
$http_host = $_SERVER["HTTP_HOST"];
$urlbase = "http://$http_host/hugo";
$has_comments = false;
$has_entry_log = true;
```


## Why v2?
This is the reimplementation of 
[this project](https://github.com/hugonikanor/website-blog)
Rewritten again from scratch, but with the intention of having a new product
looking like the old one.

## What it is
The project still is my simple blog engine.

## In action
The project's old version can probably be seen in action
[here](http://blog.hornquist.se/hugo)
