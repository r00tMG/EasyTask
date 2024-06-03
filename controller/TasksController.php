<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'ConnectDB.php';

class TasksController
{


    /**
     * @param string $description
     * @param string $category
     * @param string $priority
     * @param string $statut
     * @param int $id_users
     * @return bool
     */
    public function createTask(string $description, string $category, string $priority, string $statut, int $id_users):bool
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

    /**
     * @return array
     */
    public function displayTask():array
    {
        $connexion = new ConnectDB();
        $query = $connexion->connexion()
            ->prepare("SELECT *FROM tache");
        $query->execute();
        $tasks = $query->fetchAll();
        return $tasks;

    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteTask(int $id):void
    {

        $connexion = new ConnectDB();
        $query = $connexion
            ->connexion()
            ->prepare('DELETE FROM tache where idTask=?');
        $query->execute([$id]);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getTaskById(int $id):array
    {
        $pdo = new ConnectDB();
        $query = $pdo->connexion()
            ->prepare("Select *from tache where idTask = {$id}");
        $query->execute();
        $task = $query->fetch();
        return $task;
    }

    /**
     * @param string $description
     * @param string $category
     * @param string $priority
     * @param string $statut
     * @param int $id_users
     * @param int $id
     * @return bool
     */
    public function update(string $description, string $category, string $priority, string $statut, int $id_users, int $id):bool
    {

        $pdo = new ConnectDB();
        $queryUpdate = $pdo->connexion()
            ->prepare("update tache set  description=?,category=?,priority=?,statut=?,id_users=? where idTask = ?");
        $state = $queryUpdate->execute([$description,$category,$priority,$statut,$id_users,$id]);
        #var_dump($state);
        return $state;

    }

    /**
     * @param int $id
     * @return array
     */
    public function getTaskByIdUser(int $id):array
    {
        $pdo = new ConnectDB();
        $query = $pdo->connexion()->prepare('select *from tache where id_users='.$id.'');
         $query->execute();
        $tasks = $query->fetchAll();
        return $tasks;
    }


    /**
     * @param string $serchTerme
     * @param int $id
     * @return array
     */
    public function searchTask(string $serchTerme, int $id):array
    {
        $pdo = new ConnectDB();
        $terme = "%$serchTerme%";
        $query= $pdo->connexion()
            ->prepare('SELECT *FROM tache where description like ? and  id_users=?');
        $query->execute([$terme,$id]);
        $tasks = $query->fetchAll();
        #var_dump($tasks);
        return $tasks;
    }

    /**
     * @param string|null $category
     * @param int $id
     * @return array
     */
    public function filterTaskByCategory(?string $category, int $id):array
    {
        $pdo = new ConnectDB();
        $query = $pdo->connexion()
            ->prepare('SELECT *FROM tache where category like ? and id_users=?');
        $query->execute([$category,$id]);
        $tasks = $query->fetchAll();
        #var_dump($tasks);
        return $tasks;
    }

    /**
     * @param string|null $priority
     * @param int $id
     * @return array
     */
    public function filterTaskByPriority(?string $priority, int $id):array
    {
        $pdo = new ConnectDB();
        $query = $pdo->connexion()
            ->prepare('SELECT *FROM tache where priority like ? and id_users=?');
        $query->execute([$priority,$id]);
        $tasks = $query->fetchAll();
        #var_dump($tasks);
        return $tasks;
    }
    public function isComplete(bool $is_complete, int $id):bool
    {
        $pdo = new ConnectDB();
        $taskById = $this->getTaskById($id);
        $query = $pdo->connexion()->prepare('UPDATE tache SET is_complete =?  WHERE idTask =? ');

        $task = $query->execute([(int)$is_complete,$id]);
        return $task;
        #var_dump($taskById);
        #return $task;
    }





}
$task  = new TasksController();
#$task->update('Netoyer la maison','2','peu important','incomplète','8',62);
#$task->createTask('sfdghgjlj','vcbgngn',4,'fngfjlgf',1);
#var_dump($task->displayTask())
#var_dump($task->deleteTask(1));
// $task->getTask();
#$task->getTaskByIdUser(60);
#$task->filterTaskByPriority('peu important',8);
$task->isComplete(0,62);



