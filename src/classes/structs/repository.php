<?php
/**
 *
 *
 */

namespace pere\struct;

/**
 * repository struct
 *
 *
 */
class repository extends base
{
    /**
     * @var string
     */
    public $source;

    /**
     * @var string
     */
    public $fetcher;

    /**
     * @var string
     */
    public $target;

    /**
     * @var \pere\struct\autoload
     */
    public $autoload;

    /**
     * @var array
     */
    public $options;

    /**
     * Construct struct from given values
     *
     * @param string $version
     * @param string $author
     * @param string $message
     * @param int $date
     * @return void
     */
    public function __construct( $source = null, $fetcher = null, $target = null, autoload $autoload = null, $options = array() )
    {
        $this->source       = (string) $source;
        $this->fetcher      = (string) $fetcher;
        $this->target       = (string) $target;
        $this->autoload     = !is_null($autoload) ? $autoload : new autoload ;
        $this->options      = (array) $options;
    }
}

