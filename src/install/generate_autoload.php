#!/usr/bin/env php
<?php

    $librariedir = realpath( __DIR__ . '/../libraries' );
    //remove unused duplicate interface
    passthru('rm -fr ' . $librariedir . '/arbit_vcs_wrapper/classes/external/xml/cacheable.php');

    require $librariedir . '/phpab/src/classfinder.php';
    require $librariedir . '/phpab/src/autoloadbuilder.php';

    require $librariedir . '/DirectoryScanner/src/directoryscanner.php';
    require $librariedir . '/DirectoryScanner/src/phpfilter.php';
    require $librariedir . '/DirectoryScanner/src/includeexcludefilter.php';
    require $librariedir . '/DirectoryScanner/src/filesonlyfilter.php';

    $scanner = new \TheSeer\Tools\DirectoryScanner;
    $scanner->addInclude('*.php');

    $finder = new \TheSeer\Tools\ClassFinder;

    $found = $finder->parseMulti( $scanner( $librariedir . '/arbit_vcs_wrapper' ) );
    $found = $finder->parseMulti( $scanner( $librariedir . '/DirectoryScanner/src' ) );
    $found = $finder->parseMulti( $scanner( $librariedir . '/ezc' ) );
    $found = $finder->parseMulti( $scanner( $librariedir . '/phpab/src' ) );

    $ab = new \TheSeer\Tools\AutoloadBuilder( $finder->getClasses() );


    file_put_contents( $librariedir . '/autoload.php', $ab->render() );



    $applicationdir = realpath( __DIR__ . '/../' );
    $finder = new \TheSeer\Tools\ClassFinder;
    $finder->parseMulti( $scanner( $applicationdir . '/classes' ) );
    $finder->parseMulti( $scanner( $applicationdir . '/interfaces' ) );
    $finder->parseMulti( $scanner( $applicationdir . '/exceptions' ) );
    $ab = new \TheSeer\Tools\AutoloadBuilder( $finder->getClasses() );
    file_put_contents( $applicationdir . '/autoload.php', $ab->render() );