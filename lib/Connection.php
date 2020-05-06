<?php


class Connection
{
    /**
     * @var Connection
     */
    private static $instance;

    private function __construct()
    {
        
    }

    public static function get() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}