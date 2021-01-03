<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';
    const DB_DRIVER = 'mysql';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'ibitssem';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'root';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;


    const VIEW_PATH =  __DIR__ . "/Vue/";
    const APP_NAME = "interface de suivi des réclamations des enseignants";
    const COPIWRIT = "©2016 All Rights Reserved. Ibtssem";

    const  STATUS_TRAITEE= 'Traitée';
    const STATUS_ENCOUR = 'En cours';

    const ENSEIGNANT = 1;
    const TECHNICIEN = 2;
}
