<?php
/* 
 * 
 */

namespace pere;

/**
 *
 * @author flyingmana
 */
interface fetcher {

    public function __construct( \pere\struct\repository $repository );

    public function fetch();

}
?>
