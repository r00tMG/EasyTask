<?php
class ConnectDB
{
    public function connexion()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=taskDB','phpmyadmin','password',
            [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
            ]
        );
        return $pdo;
    }
}
#$cnx = new ConnectDB();
#var_dump($cnx);