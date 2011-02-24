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


Usage and so on
===============

we use the `wiki <https://github.com/Flyingmana/pere/wiki>`_ for such things, so have a look at it.

There is also a list of `known bugs and problems <https://github.com/Flyingmana/pere/wiki/known-bugs>`_.


Dependencies
============

Yes, even we have a few dependencies.
We are able to install some of them by ourself.
Others should be already present.

We need the following:

- php(>=5.3)
- svn
- git

We download the following libraries in a *private* subfolder.

- `arbit-vcs_wrapper <http://arbitracker.org/vcs_wrapper.html>`_
- `phpab <https://github.com/theseer/Autoload>`_ (autoload generator)
- `DirectoryScanner <https://github.com/theseer/DirectoryScanner>`_ (is needed for phpab, and it needs the fileinfo extension which should be active by default )
- `Apache Zeta Components <http://incubator.apache.org/zetacomponents/>`_ (php console applications use in generell the Zeta ConsoleTools)

