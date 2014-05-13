<?php namespace GSD\Repositories;

// File: app/src/GSD/Repositories/Repository.php

use Config;
use GSD\Entities\ListInterface;

class Repository implements RepositoryInterface
{

    protected $path;
    protected $extension;

    /**
     * Constructor. We'll throw exceptions if the path don't exist
     */
    public function __construct()
    {
        $this->path = str_finish( Config::get( 'app.gsd.folder' ), '/' );
        if ( ! is_dir( $this->path ) )
        {
            throw new \RuntimeException( "Directory doesn't exist: $this->path" );
        }
        if ( ! is_dir( $this->path . 'archived' ) )
        {
            throw new \RuntimeException( "Directory doesn't exist: $this->path" . 'archived' );
        }
        $this->extension = Config::get( 'app.gsd.extension' );
        if ( ! starts_with( $this->extension, '.' ) )
        {
            $this->extension = '.' . $this->extension;
        }
    }

    /**
     * Delete the todo list
     *
     * @param  string  $id       ID of the list
     * @param  boolean $archived True if archived
     *
     * @return boolean            True if successful
     */
    public function delete( $id, $archived = false )
    {
        $file = $this->fullpath( $id, $archived );
        if ( file_exists( $file ) )
        {
            return unlink( $file );
        }
        return false;
    }
}
