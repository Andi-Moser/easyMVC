<?php


class Connection
{
    /**
     * @var mysqli
     */
    private static $instance;

    private static function connect()
    {
        $configFile = DIR . DIRECTORY_SEPARATOR . "database.xml";

        if (!is_file($configFile)) {
            throw new Exception("database.xml missing");
        }

        $config = simplexml_load_file($configFile);

        try {
            $mysqli = new mysqli($config->host, $config->username, $config->password, $config->database);

            $mysqli->set_charset('utf8');

            return $mysqli;
        }
        catch (Exception $e) {
            throw new Exception("Could not connect to database ".$config->database.": " . $e->getMessage());
        }
    }

    public static function get() {
        if (!self::$instance) {
            self::$instance = self::connect();
        }

        return self::$instance;
    }
}