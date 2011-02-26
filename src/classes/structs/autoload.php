<?php

/**
 *
 *
 */
namespace pere\struct;

/**
 * autoload config struct
 *
 *
 */
class autoload extends base
{

    /**
     *
     * @var string[]
     */
    public $scan;

    /**
     *
     * @var string
     */
    public $outputfile;

    /**
     *
     * @var string
     */
    public $exclude;

    /**
     * Construct struct from given values
     *
     * @param string $version
     * @param string $author
     * @param string $message
     * @param int $date
     * @return void
     */
    public function __construct($scan = array(), $outputfile = 'autoload.php', $exclude = array())
    {
        $this->scan = (array) $scan;
        $this->outputfile = (string) $outputfile;
        $this->exclude     = (array) $exclude;
    }

}

