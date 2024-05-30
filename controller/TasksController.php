<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'ConnectDB.php';

class TasksController
{


    public function createTask(string $description, string $category, string $priority,string $statut,int $id_users):bool
    {
        $connection =  new ConnectDB();
        $query = $connection->connexion()
            ->prepare('INSERT INTO tache(
                  description,
                  category,
                  priority,
                  statut,
                  id_users) VALUES(?,?,?,?,?)');
        $task = $query->execute([$description, $category, $priority,$statut,$id_users]);
        return $task;
        #var_dump($task);
    }

    public function displayTask():array
    {
        $connexion = new ConnectDB();
        $query = $connexion->connexion()
            ->prepare("SELECT *FROM tache");
        $query->execute();
        $tasks = $query->fetchAll();
        return $tasks;

    }
    public function deleteTask(int $id)
    {

        $connexion = new ConnectDB();
        $query = $connexion
            ->connexion()
            ->prepare('DELETE FROM tache where idTask=?');
        $query->execute([$id]);


    }

    public function getTaskById(int $id):array
    {
        $pdo = new ConnectDB();
        $query = $pdo->connexion()
            ->prepare("Select *from tache where idTask = {$id}");
        $query->execute();
        $task = $query->fetch();
        return $task;
    }

    public function update(string $description,string $category,string $priority,string $statut,int $id_users,int $id):bool
    {

        $pdo = new ConnectDB();
        $queryUpdate = $pdo->connexion()
            ->prepare("update tache set  description=?,category=?,priority=?,statut=?,id_users=? where idTask = ?");
        $state = $queryUpdate->execute([$description,$category,$priority,$statut,$id_users,$id]);
        #var_dump($state);
        return $state;

    }

    public function getTaskByIdUser(int $id):array
    {
        $pdo = new ConnectDB();
        $query = $pdo->connexion()->prepare('select *from tache where id_users='.$id.'');
         $query->execute();
        $tasks = $query->fetchAll();
        return $tasks;
    }

    


}
$task  = new TasksController();
#$task->update('Netoyer la maison','2','peu important','incomplète','8',62);
#$task->createTask('sfdghgjlj','vcbgngn',4,'fngfjlgf',1);
#var_dump($task->displayTask())
#var_dump($task->deleteTask(1));
// $task->getTask();
#$task->getTaskByIdUser(60);