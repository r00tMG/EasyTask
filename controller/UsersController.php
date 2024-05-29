<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'ConnectDB.php';

class UsersController
{

    public function displayUsers():array
    {
        $connexion = new ConnectDB();
        $query = $connexion->connexion()->prepare('select *from users');
        $query->execute();
        return $query->fetchAll();
    }

    public function addUsers(string $username,string $password,string $photoProfile):bool
    {
        $connexion = new ConnectDB();
        $query = $connexion->connexion()->prepare('INSERT INTO users(username,password,photoProfile) values(?,?,?)');
        return $query->execute([$username,password_hash($password,PASSWORD_BCRYPT,['cost'=>12]),$photoProfile]);
    }

    public function deleteUser(int $id): void
    {
        $connexion = new ConnectDB();
        $query = $connexion->connexion()->prepare('DELETE FROM users WHERE id=?');
        $query->execute([$id]);

    }

    public function logout(array $session):bool
    {
        if(!empty($session)){
            session_start();
            unset($session);
            header('Location: ../config/login.php' );
            exit();
        }
        return true ?? false;

    }


}

$user = new UsersController();
#$user->addUsers('johgef','pasdvdsv','sdvfbfd');
#var_dump($user->isValid());
#var_dump($user->displayUsers());
#var_dump($user->deleteUsers(46));