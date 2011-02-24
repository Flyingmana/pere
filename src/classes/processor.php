<?php
/**
 * 
 */
namespace pere;
/**
 * Description of processor
 *
 * @author flyingmana
 */
class processor {

    /**
     *
     * @var \pere\struct\repository[]
     */
    public $repositories;

    /**
     *
     * @var string
     */
    public $autoloadSummaryFile;

    public function __construct( $repositories = array() ){
        $this->repositories = $repositories;
    }

    public function process(){
        $this->fetch();
        $this->buildAutoload();
    }

    protected function fetch(){
        foreach ($this->repositories as $repo) {
            
            $fetcherClass   = \class_exists( 'pere\\fetcher\\' . $repo->fetcher ) ? '\\pere\\fetcher\\' . $repo->fetcher :  $repo->fetcher ;
            $fetcher        = new $fetcherClass($repo);
            $fetcher->fetch();
        }
    }

    protected function buildAutoload(){

        $scanner = new \TheSeer\Tools\DirectoryScanner;
        $scanner->addInclude('*.php');
        $finderAll = new \TheSeer\Tools\ClassFinder;


        foreach ($this->repositories as $repo) {
            $finder = new \TheSeer\Tools\ClassFinder;
            $scan = $scanner( $repo->target );
            $finderAll->parseMulti( $scan );
            $finder->parseMulti( $scan );
            $ab = new \TheSeer\Tools\AutoloadBuilder( $finder->getClasses() );
            file_put_contents(  $repo->target . '/pere_autoload.php', $ab->render() );
        }

        if( $this->autoloadSummaryFile !== null){
            $ab = new \TheSeer\Tools\AutoloadBuilder( $finderAll->getClasses() );
            file_put_contents( $this->autoloadSummaryFile, $ab->render() );
        }

    }
}
?>
