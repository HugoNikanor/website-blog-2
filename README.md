# website-blog-2
## Dependencies
The project requires [Parsedown](https://github.com/erusev/parsedown). Clone it
into the root directory

	├── index.php
	├── bunch of other files
	├── entries/
	└── parsedown/

## Files
All blog entries should be put into ``./entries``  
Currently the directory needs to be called ``website-blog/`` and possibly be put
directly under the server root. This due to the rewrite rules in the
``.htaccess`` file.

All entries **MUST** end with ``.md``, it's also recomended that they start with
a timestamp formated as following: ``YYYYMMDD``.

## .htaccess
The htaccess is required for the links in the php and html files to be valid.
The file sholud currently not do much suspicius, **EXCEPT!**

One of the rules rewrites ''site/<anything>a`` (note trailing ``a``) into
''site/index.php?filename=anything`` (without the trailing ``a``). This is used
to allow the file list to be shown. Since regular url:s NEED to have a ``.md``
at the end to be rewritten


## Why v2?
This is the reimagining of 
[this project](https://github.com/hugonikanor/website-blog)
Rewritten again from scratch, but with the intention of having a new product
looking like the old one.

## What it is
The project still is my simple blog engine.

## In action
The project's old version can probably be seen in action
[here](http://hugoweb.ga)
