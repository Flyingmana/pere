<?php
/**
 * 
 */

namespace pere;

/**
 * Description of cli
 *
 * @author flyingmana
 */
class cli
{
    /**
     *
     * @var \ezcConsoleInput 
     */
    public $input;

    /**
     * the real path where all libraries will be placed
     * 
     * @var string
     */
    public $basedir;

    public function run()
    {

        $this->registerArguments();

        try{
            $this->input->process();
        }catch(\ezcConsoleException $e){
            echo $e->getMessage() . "\n\n";
            print $this->input->getHelpText("");
            exit(3);
        }

        try{
            \vcsCache::initialize( '/tmp/vcs_cache' );

            $this->basedir =  getcwd() . '/' . $this->input->getOption('basedir')->value;

            $definition = \json_decode(
                \file_get_contents(
                    $this->input->getOption('definition')->value
                )
            );

            $processor = new \pere\processor( $this->generateRepositoryConfigFromJson( $definition ) );
            $processor->autoloadSummaryFile = $this->basedir . '/pere_autoload.php';
            $processor->process();

        }catch(\Exception $e){
            echo $e->getMessage() . "\n\n";
            exit(3);
        }

        exit(0);
    }

    protected function registerArguments()
    {
        $this->input = new \ezcConsoleInput();

        $this->input->registerOption(new \ezcConsoleOption('h', 'help'));
        $this->input->getOption('help')->isHelpOption = true;
        $this->input->getOption('help')->shorthelp = 'Prints this usage information';


        $this->input->registerOption(new \ezcConsoleOption(
                'b', 'basedir', \ezcConsoleInput::TYPE_STRING, null, false,
                'Basedir for filepaths'
        ));
        $this->input->getOption('basedir')->mandatory = true;

        $this->input->registerOption(new \ezcConsoleOption(
                'd', 'definition', \ezcConsoleInput::TYPE_STRING, null, false,
                'location of the definition file'
        ));
        $this->input->getOption('definition')->mandatory = true;
    }



    public function generateRepositoryConfigFromJson($json)
    {
        $repositories = array();
        foreach( $json->repositories as $repo ){
            $target = $this->basedir . '/' . $repo->target;
            $repositories[] = new \pere\struct\repository(
                $repo->source,
                $repo->fetcher,
                $target,
                new \pere\struct\autoload(
                    $repo->autoload->scan,
                    $target . '/autoload.php'),
                $repo->options);
        }
        return $repositories;
    }

}

