<?php

class PdoModel
{
    public function __construct()
    {
        try {
            $settings =  $this->getSetting();
            $this->_dbh = new PDO(
                sprintf(
                    "%s:host=%s;dbname=%s",
                    $settings['database']['driver'],
                    $settings['database']['host'],
                    $settings['database']['dbname']
                ),
                $settings['database']['user'],
                $settings['database']['password'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
        } catch (PDOException $exception) {
            // Si hay error con la conexión, para el script y muestra el error.
            exit('Failed to connect to database!');
        }

    }

    private function getSetting(): array
    {
        return parse_ini_file(ROOT_PATH . '/config/settings.ini', true);
    }
}
