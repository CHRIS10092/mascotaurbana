<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
class config
{
    private function Conectar()
    {

        try {

            $adchb_dsn = 'mysql:host=localhost;dbname=veter1;charset=utf8';
            $adchb_dbh = new PDO($adchb_dsn, 'root', '');
            $adchb_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $adchb_dbh;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function Abrir()
    {
        $adchb_dbh = self::Conectar();
        return $adchb_dbh;
    }
}
