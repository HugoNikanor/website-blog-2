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

## Files
All blog entries should be put into ``./entries``  

It's also recomended that entries start with a timestamp formated as following: ``YYYYMMDD``.


## Why v2?
This is the reimplementation of 
[this project](https://github.com/hugonikanor/website-blog)
Rewritten again from scratch, but with the intention of having a new product
looking like the old one.

## What it is
The project still is my simple blog engine.

## In action
The project's old version can probably be seen in action
[here](http://hugoweb.ga)
