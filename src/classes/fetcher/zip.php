<?php

namespace pere\fetcher;

class zip implements \pere\fetcher {

    /**
     * @var \pere\struct\repository 
     */
    public $repository;

    /**
     *
     *
     * @param \pere\struct\repository $repository the repository config
     */
    public function __construct( \pere\struct\repository $repository ){
        $this->repository = $repository;
    }

    /**
     * fetch the repository and extract it to the target dir
     *
     */
    public function fetch(){
		$url = $this->repository->source; 
		
		// create a tmpfile for downloading the zip archive
		$tmpfname = \tempnam('/tmp', 'pere');

		$urlzip = \fopen($url,'rb');
		\file_put_contents( $tmpfname , \stream_get_contents($urlzip) );

		$file = $tmpfname;

		$basefolder = '';
		if( \is_array($this->repository->options) && array_key_exists('subfolder',$this->repository->options) ) {
			$basefolder = $this->repository->options['subfolder'];
		}

		if( !file_exists($this->repository->target) ) {
			\mkdir($this->repository->target);
		}
		
		$za = new \ZipArchive();
		$za->open($file);
		
		$extract = array();
		for ($i=0; $i<$za->numFiles;$i++) {
			$name = $za->getNameIndex($i);
			if( $basefolder=='' || \substr($name, 0, \strlen($basefolder) )==$basefolder ) {
				$nameInFilesystem = $this->repository->target.'/'.\substr($name, \strlen($basefolder));
				
				if( \substr($nameInFilesystem, -1,1)=='/' ) {
					if( !\file_exists($nameInFilesystem) ){
						\mkdir( $nameInFilesystem );
					}
				} else {
					\copy('zip://'.$file.'#'.$name, $nameInFilesystem);
				}
			}
		}
		\unlink($tmpfname);
    }


}
