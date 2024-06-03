<?php
session_start();
if($_SESSION['users']==[]){
    header('Location: config/login.php');
    exit(0);
}
$title = 'Home EasyTask';
require_once 'views/header.php';
require_once 'views/menu.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'TasksController.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'UsersController.php';
$tasks = new TasksController();
$listTask = $tasks->getTaskByIdUser($_SESSION['users']['id_users']);
$listTaskAdmin = $tasks->displayTask();
if (isset($_POST['delete'])) {
    $id = $_POST['idTask'];
    $tasks->deleteTask($id);
    echo '
        <script>
        alert("Votre tâche a été supprimé avec succés")
        </script>
    ';
}

if(isset($_POST['createTask'])){
    if(
            !empty($_POST['id_users']) &&
            !empty($_POST['description']) &&
            !empty($_POST['category']) &&
            !empty($_POST['priority']) &&
            !empty($_POST['statut'])

    ){
        $task = new TasksController();
        $tasks = $task->createTask($_POST['description'],$_POST['category'],$_POST['priority'],$_POST['statut'],$_POST['id_users']);
        echo '
            <script>
                alert("Votre tâche a été créé avec succées)
            </script>
        ';
    }
}

#var_dump($_SESSION);
if( isset($_POST['categoryFilter']) ){
    $taskByCategory = $tasks->filterTaskByCategory( $_POST['categoryFilter'], $_SESSION['users']['id_users'] );
    #var_dump($taskByCategory);
}
if ( isset($_POST['priorityFilter']) ){
    $taskByPriority = $tasks->filterTaskByPriority( $_POST['priorityFilter'], $_SESSION['users']['id_users'] );
#    var_dump($taskByPriority);
}
#echo "<pre>";
#var_dump($listTaskAdmin);
?>

<div class="container rounded shadow m-auto p-5 mt-5 ">
<?php if($_SESSION['users']['username'] !== 'admin@gmail.com'):?>
    <div class="container  my-5">
        <div class="row m-auto w-50">
            <div class="col-md-4 ">
                <form method="POST">
                    <div class="row">
                        <h5 class="form-label">By Category:</h5>
                        <div class="col">
                            <select class="form-control" name="categoryFilter">
                                <option selected  value="" >Choisir...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col">
                            <button type="submit"  class="btn btn-outline-dark">Valider</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                <form method="POST">
                    <div class="row">
                        <h5 class="form-label">By Priority:</h5>
                        <div class="col">
                            <select class="form-control" name="priorityFilter">
                                <option selected disabled value="" >Choisir...</option>
                                <option value="important">important</option>
                                <option value="peu important">peu important</option>
                            </select>
                        </div>
                        <div class="col">
                            <button type="submit"  class="btn btn-outline-dark">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4 mt-5 m-auto">
            <div class="">
                <form class="form-group" method="GET">
                    <input name="search" class="form-control" placeholder="Search..."  />
                </form>
            </div>
        </div>
    </div>
<?php endif;?>


    <h2 class="text-center text-secondary text-xxs font-weight-bolder opacity-7"> Liste des tâches </h2>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered align-items-center mb-0">
                <thead>
                <tr>
                    <?php if($_SESSION['users']['username'] == 'admin@gmail.com'):?>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">userID</th>
                    <?php endif;?>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Priority</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="4">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php  if($_SESSION['users']['username'] == 'admin@gmail.com'): ?>
                        <?php
                            #var_dump($listTaskAdmin[5]['id_users']);
                           for ($i=0;$i<count($listTaskAdmin);$i++){
                           echo '<tr>
                                 <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-xs text-center">'.$listTaskAdmin[$i]['id_users'].'</h6>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0">'.$listTaskAdmin[$i]['description'].'</p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0">'.$listTaskAdmin[$i]['category'].'</p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0">'.$listTaskAdmin[$i]['priority'].'</p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0">'.$listTaskAdmin[$i]['statut'].'</p>
                                </td>
                                <td>
    
                                    <form class="text-center" method="POST">
                                        <input type="hidden" name="idTask" value="'.$listTaskAdmin[$i]['idTask'].'">
                                        <button class="btn btn-transparent" name="delete">
                                            <svg stroke="currentColor" class="text-danger" fill="currentColor" stroke-width="0"
                                                 viewBox="0 0 1024 1024" height="1em" width="1em"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M292.7 840h438.6l24.2-512h-487z"></path>
                                                <path d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-504-72h304v72H360v-72zm371.3 656H292.7l-24.2-512h487l-24.2 512z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-transparent">
                                        <a href="views/edit.php?id='.$listTaskAdmin[$i]['idTask'].'">
                                            <svg stroke="currentColor" class="text-success" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M7,17.013l4.413-0.015l9.632-9.54c0.378-0.378,0.586-0.88,0.586-1.414s-0.208-1.036-0.586-1.414l-1.586-1.586	c-0.756-0.756-2.075-0.752-2.825-0.003L7,12.583V17.013z M18.045,4.458l1.589,1.583l-1.597,1.582l-1.586-1.585L18.045,4.458z M9,13.417l6.03-5.973l1.586,1.586l-6.029,5.971L9,15.006V13.417z"></path><path d="M5,21h14c1.103,0,2-0.897,2-2v-8.668l-2,2V19H8.158c-0.026,0-0.053,0.01-0.079,0.01c-0.033,0-0.066-0.009-0.1-0.01H5V5	h6.847l2-2H5C3.897,3,3,3.897,3,5v14C3,20.103,3.897,21,5,21z"></path></svg>
                                        </a>
                                    </button>
                                </td>
                            </tr>';
                           }

                        ?>
                    <?php elseif (isset($_SESSION['users']['username']) && !empty($_GET['search'])):?>
                        <?php $listTaskSearching = $tasks->searchTask($_GET['search'],$_SESSION['users']['id_users']);?>
                        <?php #var_dump($listTaskSearching);?>
                        <?php for ($i=0;$i<count($listTaskSearching);$i++): ?>
                        <tr>

                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?=$listTaskSearching[$i]['description'] ?></p>
                        </td>
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?=$listTaskSearching[$i]['category']?></p>
                        </td>
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?=$listTaskSearching[$i]['priority']?></p>
                        </td>
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?=$listTaskSearching[$i]['statut']?></p>
                        </td>
                        <td>

                        <?php if($_SESSION['users']['username'] == 'admin@gmail.com'): ?>
                            <td>
                                <form class="text-center" method="POST">
                                    <input type="hidden" name="idTask" value="<?=$listTaskSearching[$i]['idTask']?>">
                                    <button class="btn btn-transparent" name="delete">
                                        <svg stroke="currentColor" class="text-danger" fill="currentColor" stroke-width="0"
                                             viewBox="0 0 1024 1024" height="1em" width="1em"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M292.7 840h438.6l24.2-512h-487z"></path>
                                            <path d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-504-72h304v72H360v-72zm371.3 656H292.7l-24.2-512h487l-24.2 512z"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <button class="btn btn-transparent">
                                    <a href="views/edit.php?id=<?=$listTaskSearching[$i]['idTask']?>">
                                        <svg stroke="currentColor" class="text-success" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M7,17.013l4.413-0.015l9.632-9.54c0.378-0.378,0.586-0.88,0.586-1.414s-0.208-1.036-0.586-1.414l-1.586-1.586	c-0.756-0.756-2.075-0.752-2.825-0.003L7,12.583V17.013z M18.045,4.458l1.589,1.583l-1.597,1.582l-1.586-1.585L18.045,4.458z M9,13.417l6.03-5.973l1.586,1.586l-6.029,5.971L9,15.006V13.417z"></path><path d="M5,21h14c1.103,0,2-0.897,2-2v-8.668l-2,2V19H8.158c-0.026,0-0.053,0.01-0.079,0.01c-0.033,0-0.066-0.009-0.1-0.01H5V5	h6.847l2-2H5C3.897,3,3,3.897,3,5v14C3,20.103,3.897,21,5,21z"></path></svg>
                                    </a>
                                </button>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php endfor; ?>
                    <?php elseif(isset($_POST['categoryFilter'])):?>
                        <?php for ($i=0;$i<count($taskByCategory);$i++): ?>
                            <tr>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0"><?= $taskByCategory[$i]['description'] ;?></p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0"><?= $taskByCategory[$i]['category'] ;?></p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0"><?= $taskByCategory[$i]['priority'] ;?></p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0"><?= $taskByCategory[$i]['statut'] ;?></p>
                                </td>
                                <?php if($_SESSION['users']['username'] == 'admin@gmail.com'): ?>
                                    <td>
                                        <form class="text-center" method="POST">
                                            <input type="hidden" name="idTask" value="<?=$taskByCategory[$i]['idTask']?>">
                                            <button class="btn btn-transparent" name="delete">
                                                <svg stroke="currentColor" class="text-danger" fill="currentColor" stroke-width="0"
                                                     viewBox="0 0 1024 1024" height="1em" width="1em"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M292.7 840h438.6l24.2-512h-487z"></path>
                                                    <path d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-504-72h304v72H360v-72zm371.3 656H292.7l-24.2-512h487l-24.2 512z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-transparent">
                                            <a href="views/edit.php?id=<?=$taskByCategory[$i]['idTask']?>">
                                                <svg stroke="currentColor" class="text-success" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M7,17.013l4.413-0.015l9.632-9.54c0.378-0.378,0.586-0.88,0.586-1.414s-0.208-1.036-0.586-1.414l-1.586-1.586	c-0.756-0.756-2.075-0.752-2.825-0.003L7,12.583V17.013z M18.045,4.458l1.589,1.583l-1.597,1.582l-1.586-1.585L18.045,4.458z M9,13.417l6.03-5.973l1.586,1.586l-6.029,5.971L9,15.006V13.417z"></path><path d="M5,21h14c1.103,0,2-0.897,2-2v-8.668l-2,2V19H8.158c-0.026,0-0.053,0.01-0.079,0.01c-0.033,0-0.066-0.009-0.1-0.01H5V5	h6.847l2-2H5C3.897,3,3,3.897,3,5v14C3,20.103,3.897,21,5,21z"></path></svg>
                                            </a>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endfor;?>
                    <?php elseif( isset($_POST['priorityFilter']) ):?>
                        <?php for ($i=0;$i<count($taskByPriority);$i++): ?>
                                <tr>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0"><?= $taskByPriority[$i]['description'] ;?></p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0"><?= $taskByPriority[$i]['category'] ;?></p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0"><?= $taskByPriority[$i]['priority'] ;?></p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0"><?= $taskByPriority[$i]['statut'] ;?></p>
                                </td>
                                <?php if($_SESSION['users']['username'] == 'admin@gmail.com'): ?>
                                    <td>
                                        <form class="text-center" method="POST">
                                            <input type="hidden" name="idTask" value="<?=$taskByPriority[$i]['idTask']?>">
                                            <button class="btn btn-transparent" name="delete">
                                                <svg stroke="currentColor" class="text-danger" fill="currentColor" stroke-width="0"
                                                     viewBox="0 0 1024 1024" height="1em" width="1em"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M292.7 840h438.6l24.2-512h-487z"></path>
                                                    <path d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-504-72h304v72H360v-72zm371.3 656H292.7l-24.2-512h487l-24.2 512z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-transparent">
                                            <a href="views/edit.php?id=<?=$taskByPriority[$i]['idTask']?>">
                                                <svg stroke="currentColor" class="text-success" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M7,17.013l4.413-0.015l9.632-9.54c0.378-0.378,0.586-0.88,0.586-1.414s-0.208-1.036-0.586-1.414l-1.586-1.586	c-0.756-0.756-2.075-0.752-2.825-0.003L7,12.583V17.013z M18.045,4.458l1.589,1.583l-1.597,1.582l-1.586-1.585L18.045,4.458z M9,13.417l6.03-5.973l1.586,1.586l-6.029,5.971L9,15.006V13.417z"></path><path d="M5,21h14c1.103,0,2-0.897,2-2v-8.668l-2,2V19H8.158c-0.026,0-0.053,0.01-0.079,0.01c-0.033,0-0.066-0.009-0.1-0.01H5V5	h6.847l2-2H5C3.897,3,3,3.897,3,5v14C3,20.103,3.897,21,5,21z"></path></svg>
                                            </a>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endfor;?>
                    <?php else:?>
                    <?php for ($i=0;$i<count($listTask);$i++): ?>
                        <tr>
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?= $listTask[$i]['description'] ;?></p>
                        </td>
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?= $listTask[$i]['category'] ;?></p>
                        </td>
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?= $listTask[$i]['priority'] ;?></p>
                        </td>

                        <td>
                            <form method="POST">
                                <input type="hidden" name="is_complete" value="<?= htmlentities($listTask[$i]['is_complete']) ?>">
                                <input type="hidden" name="idTask" value="<?= htmlentities($listTask[$i]['idTask']) ?>">
                                <button type="submit" name="status" class="btn btn-primary">
                                    <?= $listTask[$i]['is_complete'] ==0 ? 'Incomplete' : 'Complete' ?>
                                </button>
                            </form>
                            <span>
                                <?php
                                #$listTask[$i]['is_complete'] ? '(Complete)' : '(Incomplete)';
                                 ?>
                            </span>

                            <?php
                            if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status']) && isset($_POST['idTask']) ) {
                                $idTask = $_POST['idTask'];
                                $currentStatus = $_POST['is_complete'];
                                $newStatus = $currentStatus ? 0 : 1;
                                $task->isComplete($newStatus, $idTask);

                                // Redirige pour éviter la soumission multiple du formulaire
                                #header('Location: ' . $_SERVER['REQUEST_URI']);
                                #exit();
                            }
                               ?>

                        </td>
                            <?php if($_SESSION['users']['username'] == 'admin@gmail.com'): ?>
                        <td>
                            <form class="text-center" method="POST">
                                <input type="hidden" name="idTask" value="<?=$listTask[$i]['idTask']?>">
                                <button class="btn btn-transparent" name="delete">
                                <svg stroke="currentColor" class="text-danger" fill="currentColor" stroke-width="0"
                                     viewBox="0 0 1024 1024" height="1em" width="1em"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M292.7 840h438.6l24.2-512h-487z"></path>
                                    <path d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-504-72h304v72H360v-72zm371.3 656H292.7l-24.2-512h487l-24.2 512z"></path>
                                </svg>
                                </button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-transparent">
                                <a href="views/edit.php?id=<?=$listTask[$i]['idTask']?>">
                                <svg stroke="currentColor" class="text-success" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M7,17.013l4.413-0.015l9.632-9.54c0.378-0.378,0.586-0.88,0.586-1.414s-0.208-1.036-0.586-1.414l-1.586-1.586	c-0.756-0.756-2.075-0.752-2.825-0.003L7,12.583V17.013z M18.045,4.458l1.589,1.583l-1.597,1.582l-1.586-1.585L18.045,4.458z M9,13.417l6.03-5.973l1.586,1.586l-6.029,5.971L9,15.006V13.417z"></path><path d="M5,21h14c1.103,0,2-0.897,2-2v-8.668l-2,2V19H8.158c-0.026,0-0.053,0.01-0.079,0.01c-0.033,0-0.066-0.009-0.1-0.01H5V5	h6.847l2-2H5C3.897,3,3,3.897,3,5v14C3,20.103,3.897,21,5,21z"></path></svg>
                                </a>
                            </button>
                        </td>
                            <?php endif; ?>
                </tr>
                    <?php endfor;?>
                <?php endif ;?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
require_once 'views/footer.php'
?>
