<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 10/30/17
 * Time: 6:59 PM
 */

namespace AC;

use AC\Bootstrap\Config;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Application
{
    /**
     * The base path for the Laravel installation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The custom environment path defined by the developer.
     *
     * @var string
     */
    protected $environmentPath;

    /**
     * The environment file to load during bootstrapping.
     *
     * @var string
     */
    protected $environmentFile = '.env';

    /**
     * @var Config
     */
    protected $config;

    /**
     * Application constructor.
     */
    public function __construct( $basePath = null )
    {
        if ( is_null( $basePath ) ) {
            $basePath = realpath( __DIR__ . '/../' );
        }
        $this->setBasePath( $basePath );
    }

    /**
     *
     */
    public function bootstrapConfig()
    {
        $this->config = new Config( $this );

        return $this->config->repository();
    }

    /**
     * Set the base path for the application.
     *
     * @param  string $basePath
     *
     * @return $this
     */
    public function setBasePath( $basePath )
    {
        $this->basePath = rtrim( $basePath, '\/' );

        return $this;
    }

    /**
     * Get the path to the application "app" directory.
     *
     * @return string
     */
    public function path()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'app';
    }

    /**
     * Get the base path of the Laravel installation.
     *
     * @return string
     */
    public function basePath()
    {
        return $this->basePath;
    }

    /**
     * Get the path to the bootstrap directory.
     *
     * @return string
     */
    public function bootstrapPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'bootstrap';
    }

    /**
     * Get the path to the application configuration files.
     *
     * @return string
     */
    public function configPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'config';
    }

    /**
     * Get the path to the language files.
     *
     * @return string
     */
    public function langPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang';
    }

    /**
     * Get the path to the public / web directory.
     *
     * @return string
     */
    public function publicPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'public';
    }

    /**
     * Get the path to the environment file directory.
     *
     * @return string
     */
    public function environmentPath()
    {
        return $this->environmentPath ?: $this->basePath;
    }

    /**
     * Set the directory for the environment file.
     *
     * @param  string $path
     *
     * @return $this
     */
    public function useEnvironmentPath( $path )
    {
        $this->environmentPath = $path;

        return $this;
    }

    /**
     * Set the environment file to be loaded during bootstrapping.
     *
     * @param  string $file
     *
     * @return $this
     */
    public function loadEnvironmentFrom( $file )
    {
        $this->environmentFile = $file;

        return $this;
    }

    /**
     * Get the environment file the application is using.
     *
     * @return string
     */
    public function environmentFile()
    {
        return $this->environmentFile ?: '.env';
    }

    /**
     * Get the fully qualified path to the environment file.
     *
     * @return string
     */
    public function environmentFilePath()
    {
        return $this->environmentPath() . '/' . $this->environmentFile();
    }

    /**
     * Get or check the current application environment.
     *
     * @param  mixed
     *
     * @return string|bool
     */
    public function environment()
    {
        if ( func_num_args() > 0 ) {
            $patterns = is_array( func_get_arg( 0 ) ) ? func_get_arg( 0 ) : func_get_args();

            foreach ( $patterns as $pattern ) {
                if ( Str::is( $pattern, $this[ 'env' ] ) ) {
                    return true;
                }
            }

            return false;
        }

        return $this[ 'env' ];
    }

    /**
     * Throw an HttpException with the given data.
     *
     * @param  int    $code
     * @param  string $message
     * @param  array  $headers
     *
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function abort( $code, $message = '', array $headers = [] )
    {
        if ( $code == 404 ) {
            throw new NotFoundHttpException( $message );
        }

        throw new HttpException( $code, $message, null, $headers );
    }
}
