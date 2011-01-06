Why not PEAR?
=============

PEAR has a big problem.
To use a software over PEAR, it must be released as PEAR-Package.
But not every developer wants to create a PEAR-Package for his software.

Also it is quite a much work, if you need software via PEAR for your Projekt,
which is not available over PEAR yet, so that you must create an own package with
all your needed dependencies.


What do we better?
==================

We serve a general way, to *install* software into the php include path direct from
the source. This means, even from git or svn repositories.

We will provide an interface for using pere in your own projects
if you want an individual lib dir.
