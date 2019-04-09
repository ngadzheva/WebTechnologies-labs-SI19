<?php
    class Config
    {
        public static function _init()
        {
            $config = parse_ini_file(__DIR__ . "/config.ini", true);
            if (!defined("CONFIG")) {
                define("CONFIG", serialize($config));                
            }
        }
    }
?>