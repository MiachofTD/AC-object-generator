<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 10/30/17
 * Time: 7:29 PM
 */

namespace AC\Bootstrap;

use AC\Application;
use Illuminate\Config\Repository;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Contracts\Config\Repository as RepositoryContract;

class Config
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * Config constructor.
     *
     * @param Application $app
     */
    public function __construct( Application $app )
    {
        $config = new Repository( [] );
        $this->loadConfigurationFiles( $app, $config );

        $this->repository = $config;

        mb_internal_encoding( 'UTF-8' );
    }

    public function repository()
    {
        return $this->repository;
    }

    /**
     * Load the configuration items from all of the files.
     *
     * @param  Application $app
     * @param  \Illuminate\Contracts\Config\Repository      $repository
     *
     * @return void
     */
    protected function loadConfigurationFiles( Application $app, RepositoryContract $repository )
    {
        foreach ( $this->getConfigurationFiles( $app ) as $key => $path ) {
            $repository->set( $key, require $path );
        }
    }

    /**
     * Get all of the configuration files for the application.
     *
     * @param  Application $app
     *
     * @return array
     */
    protected function getConfigurationFiles( Application $app )
    {
        $files = [];

        $configPath = realpath( $app->configPath() );

        foreach ( Finder::create()->files()->name( '*.php' )->in( $configPath ) as $file ) {
            $nesting = $this->getConfigurationNesting( $file, $configPath );

            $files[ $nesting . basename( $file->getRealPath(), '.php' ) ] = $file->getRealPath();
        }

        return $files;
    }

    /**
     * Get the configuration file nesting path.
     *
     * @param  \Symfony\Component\Finder\SplFileInfo $file
     * @param  string                                $configPath
     *
     * @return string
     */
    protected function getConfigurationNesting( SplFileInfo $file, $configPath )
    {
        $directory = dirname( $file->getRealPath() );

        if ( $tree = trim( str_replace( $configPath, '', $directory ), DIRECTORY_SEPARATOR ) ) {
            $tree = str_replace( DIRECTORY_SEPARATOR, '.', $tree ) . '.';
        }

        return $tree;
    }
}