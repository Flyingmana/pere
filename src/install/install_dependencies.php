<?php
/**
 * we like using clean reusable code,
 * so we need to install a few libraries.
 * 
 *
 */

chdir(__DIR__);
$librariedir = "../libraries";
passthru("rm -fr $librariedir");
mkdir($librariedir);
chdir($librariedir);


$repository = "git://github.com/theseer/DirectoryScanner.git";
$targetdir  = "DirectoryScanner";
passthru("git clone $repository $targetdir");

$repository = "http://svn.apache.org/repos/asf/incubator/zetacomponents/scripts/";
$targetdir  = "ezc/current/scripts";
passthru("svn export $repository $targetdir");

$repository = "http://svn.apache.org/repos/asf/incubator/zetacomponents/trunk/Base/src/";
$targetdir  = "ezc/current/Base/src";
passthru("svn export $repository $targetdir");

$repository = "http://svn.apache.org/repos/asf/incubator/zetacomponents/trunk/ConsoleTools/src/";
$targetdir  = "ezc/current/ConsoleTools/src";
passthru("svn export $repository $targetdir");




$repository = "git://github.com/theseer/Autoload.git";
$targetdir  = "phpab";
passthru("git clone $repository $targetdir");

$repository = "svn://arbitracker.org/arbit/projects/vcs_wrapper/trunk/src";
$targetdir  = "arbit_vcs_wrapper";
passthru("svn export $repository $targetdir");


chdir("ezc/current");
passthru("./scripts/setup-env.sh");

